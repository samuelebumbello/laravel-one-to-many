<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/contatti', [PageController::class, 'contacts'])->name('contacts');


Route::middleware(['auth' , 'verified'])
        //Prefisso tutti i file
        ->name('admin.')
        //Prefisso uri
        ->prefix('admin')
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('home');
            //Aggiungiamo qui le altre rotte protette
            Route::get('/stats', [DashboardController::class, 'stats'])->name('stats');
            Route::resource('projects', ProjectController::class);
            Route::get('orderby/{direction}', [ProjectController::class, 'orderby'])->name('orderby');
        });

require __DIR__.'/auth.php';
