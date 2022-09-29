<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotMails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fecha_envio')->nullable();
            $table->boolean('publicidad')->default(false);
            $table->boolean('saldo')->default(false);
            $table->string('template');
            $table->json('footer')->nullable();
            $table->timestamps();
            $table->softDeletes();
            //$table->boolean('enabled')->default(true)->index();
            $table->auditable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slot_mails');
    }
}
