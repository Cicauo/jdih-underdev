<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_produk');
            $table->unsignedInteger('id_peraturan');
            $table->unsignedInteger('id_katalog');
            $table->string('nama_dokumen',255);
            $table->string('nomor_dokumen',255);
            $table->string('file_dokumen',255);
            $table->integer('tahun_dokumen');
            $table->boolean('berlaku');
            $table->text('desc_dokumen')->nullable();
            $table->text('abstrak')->nullable();
            $table->string('mencabut_dicabut',255)->nullable();
            $table->string('ditetapkan',255)->nullable();
            $table->string('diundangkan',255)->nullable();
            $table->string('lembaran_negara',255)->nullable();
            $table->string('berita_negara',255)->nullable();
			$table->integer('download')->nullable();
			$table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
			$table->foreign('id_peraturan')->references('id')->on('peraturan')->onDelete('cascade');
			$table->foreign('id_katalog')->references('id')->on('katalog')->onDelete('cascade');
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
        Schema::dropIfExists('dokumen');
    }
}
