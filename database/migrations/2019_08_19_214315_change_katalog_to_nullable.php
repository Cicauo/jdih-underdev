<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeKatalogToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen', function (Blueprint $table) {
			$table->dropForeign(['id_katalog']);
			$table->unsignedInteger('id_katalog')->nullable()->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::table('dokumen', function (Blueprint $table) {
			$table->foreign('id_katalog')->references('id')->on('katalog')->onDelete('cascade');
		});
    }
}
