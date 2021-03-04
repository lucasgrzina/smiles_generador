<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultToContenidoPredefinidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contenido_predefinidos', function (Blueprint $table) {
            $table->boolean('default')->default(false)->index()->after('contenido');;
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
            $table->dropColumn(['default']);
        });
    }
}
