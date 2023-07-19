<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTarjetaSuspIdToSlotEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slot_mails', function (Blueprint $table) {
            
            $table->unsignedInteger('tarjeta_susp_id')->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slot_mails', function (Blueprint $table) {
            $table->dropColumn(['tarjeta_susp_id']);
        });        
    }
}
