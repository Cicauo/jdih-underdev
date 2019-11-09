<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('logo')->nullable();
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->text('slider1')->nullable();
            $table->text('slider2')->nullable();
            $table->text('slider3')->nullable();
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
        Schema::dropIfExists('cms');
    }
}
