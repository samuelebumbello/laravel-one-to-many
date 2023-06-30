<?php

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            //Creo colonna per la FK
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            $table->foreign('category_id')
                    ->references('id')      //Quale colonna? 'id'
                    ->on('categories')      //Di quale tabella? 'categories'
                    ->onDelete('set null'); //Se elimino una categoria i post in relazione non vengono persi e avranno category_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //Elimino la FK
            $table->dropForeign(['category_id']);

            //Elimino la colonna
            $table->dropColumn('category_id');
        });
    }
};
