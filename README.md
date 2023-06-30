<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Laravel_auth
------
**Descrizione**

Nuovo progetto usando laravel breeze ed il pacchetto Laravel 9 Preset con autenticazione.

**Se si vuole clonare la repository i comandi da eseguire per il corretto funzionamento sono;**
- Duplicare e rinominare il file .env
- Eseguire comando npm i 
- Eseguire comando composer install
- Creare la key con php artisan key:generate
- Eseguire comando npm run dev
- Eseguire comando php artisan serve
- Eseguire comando php artisan storage:link (solo se si hanno problemi nella visualizzazione delle immagini.)

---------
**TODO:**

1. Creare progetto con comando:;

    **composer create-project laravel/laravel:^9.2 nome_cartella**

2. Installare breeze (tool) con comando;

    **composer require laravel/breeze --dev**

3. Install

    **php artisan breeze:install**

4. Installare pacchetto pacifici:

    **composer require pacificdev/laravel_9_preset**

5. Installare bootstrap;

    **php artisan preset:ui bootstrap --auth**

6. Lanciare comando **'npm i'**;

7. Apriamo due terminali e lanciamo il progetto;

**- npm run dev**

**- php artisan serve**

----------------
## Creazione database

8. Creiamo il nostra db con phpmyadmin e lo agganciamo al progetto tramite .env

9. Creiamo la migration con il comando;

    **php artisan migrate**

10. Controlliamo che siano stati aggiunti in campi nel db!

-------

## Layouts

1. Cominciamo a separare gli ambienti;

    - Creiamo cartella **guest** in views
    - Creiamo file home.blade.php in guest
    
    - Creiamo cartella **admin** in views
    - Creiamo file home.blade.php in admin

**Home deve estendere 'layouts.guest'**

**Mentre nel FILE guest.blade.php inseriamo la @section('content')**

2. Diviamo gli stili ;

- Andiamo in vite.config.js e aggiungiamo due file per la cartella guest;

- Creiamo i due file; 

In scss aggiungiamo file appGuest.scss 

In js aggiungiamo file appGuest.js

----------

**Admin deve estendere layouts.admin**

- Andiamo in views->profile->dashboard.blade.php (che poi elimineremo) e copiamo la struttura nel file home.blade.php dell'admin. 

## NB
Per fare in modo che tutti funzioni correttamente, torniamo nel file guest.blade.php e correggiamo i file @vite che altre ad essere 'appGuest' sono scss e non css.

Nella cartella Providers->RouteServiceProvider dobbiamo sostituire '/dashboard' con '/admin'

----------

## Route

Prima di impostare le rotte, creiamo il nostro Controller;

**php artisan make:controller Guest/PageController**

Andiamo nel app->Http->Controllers e controlliamo che ci sia il nostro, allora entriamo e inseriamo la public function che punterà sulla nostra 'guest.home'.

In web.php possiamo collegare la nostra rotta;

1. Importiamo con **use** il percorso del nostro controller (se non lo fa automaticamente)
2. Stabiliamo la rotta;

*Route::get('/', [PageController::class, 'index'])->name('home');*

---------

## Route admin

Cancelliamo tutte le route esistenti, tranne quella creata da noi e il require di auth;

Prima di impostare le rotte, creiamo il nostro Admin/DashboardController;

**php artisan make:controller Admin/DashboardController**

Entriamo nel Controller e creiamo la nostra public function:

    *public function index(){

        return view('admin.home');
    }*

In web.php inseriamo le rotte protette da middleware:

     Route::middleware(['auth' , 'verified'])
        ->name('admin')
        ->prefix('admin')
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('home');
        });

A questo punto il nostro layouts base è completo, volendo possiamo aggiungere pagine 

----------

## Gestione errori 

Creiamo la request con il comando **php artisan make:request NomeRequest**

Apriamo il file appena generato e in authorize cambiato il **false** con **true** 

In rules aggiungiamo i controlli che vogliamo effettuare

Aggiungiamo una **public function messages()** e nel return scriviamo i nostri controlli

Nella file blade.php inseriamo gli errori nei campi prescelti con **@errors**

-------

## Inseriamo le immagine nello Storage

Caricare file nella cartella storage/app/public

In .env sostituire 'local' con 'public'

Creiamo un symlink della cartella storage che punta nella cartella public:

**php artisan storage:link**

Al form inseriamo **enctype="multipart/form-data"** per indicare che contiene dei files.

-------------
<br>

## Aggiungiamo la "Category" - Relazione One to Many

<br>


Creiamo una nuova Migration 
**php artisan make:model Category -m**

Popoliamo la migration e lanciamo con il comando 
**php artisan migrate**

Creiamo il Seeder 
**php artisan make:seeder CategoryTableSeeder**

NB: Se prima di effettuare il save del seeder, vogliamo controllare con un dump che sia tutto corretto, possiamo lanciare questo comando nel terminale: 
**php artisan db:seed --class=NomeSeeder**

Creiamo una migration update con il comando 
**php artisan make:migration update_projects_table --table=projects**

Rilanciamo la migrate per controllare che non ci siano errori
**php artisan migrate**

<h2>Mettiamo in relazione la nostre tabelle:</h2>

In questo caso "projects" è la tabella che contina la FK , quindi andiamo nel model e creiamo una public function il cui nome sarà il nome della tabella al singolare(la categoria è una, i projects sono tanti)

Nel model della tabella Category, facciamo il contrario;

anche qui creiamo una public function il cui nome sarà il nome della tabella al plurale(i projects sono tanti, la categoria è una)

Nel DatabaseSeeder.php aggiungiamo anche Category












