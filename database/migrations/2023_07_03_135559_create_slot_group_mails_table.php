<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotGroupMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_mail_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('slot_mail_id')->index();
            $table->char('tipo',1)->default('')->index();
            $table->integer('order')->default(1)->index();
            $table->string('nombre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slot_mail_groups');
    }
}
