<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotMailContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_mail_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('slot_mail_id')->index();
            $table->json('contenido')->nullable();
            $table->json('legales')->nullable();
            $table->integer('order')->default(1)->index();
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
        Schema::drop('slot_mail_contents');
    }
}
