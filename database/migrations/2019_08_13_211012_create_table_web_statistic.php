<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWebStatistic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_statistic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip',255)->nullable();
            $table->text('session_id')->nullable();
            $table->string('browser',255)->nullable();
            $table->string('device_type',255)->nullable();
            $table->string('os',255)->nullable();
            $table->string('is_mobile',100)->nullable();
            $table->string('ref_url_name',255)->nullable();
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
        Schema::dropIfExists('web_statistic');
    }
}
