<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJsoncontenidosToCustomMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_mails', function (Blueprint $table) {
            $table->json('contenido')->nullable()->after('template');
            $table->json('footer')->nullable()->after('contenido');
            $table->json('legales')->nullable()->after('footer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_mails', function (Blueprint $table) {
            $table->dropColumn(['contenido', 'footer', 'legales']);
        });
    }
}
