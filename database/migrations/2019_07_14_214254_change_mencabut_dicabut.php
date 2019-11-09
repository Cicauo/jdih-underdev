<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMencabutDicabut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen', function (Blueprint $table) {
			$table->dropColumn('mencabut_dicabut');
			$table->integer('mencabut')->nullable();
			$table->integer('dicabut')->nullable();
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
			$table->dropColumn('mencabut');
			$table->dropColumn('dicabut');
			$table->string('mencabut_dicabut',255)->nullable();
		});
    }
}
