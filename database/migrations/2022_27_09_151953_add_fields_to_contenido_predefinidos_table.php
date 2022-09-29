<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToContenidoPredefinidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contenido_predefinidos', function (Blueprint $table) {
            
            $table->char('seccion',1)->default('c')->after('contenido')->index();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contenido_predefinidos', function (Blueprint $table) {
            $table->dropColumn(['seccion']);
        });        
    }
}
