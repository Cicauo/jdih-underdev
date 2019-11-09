<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveIdProdukFromDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen', function (Blueprint $table) {
			$table->dropColumn('id_produk');
			$table->dropColumn('nama_dokumen');
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
			$table->string('nama_dokumen',255);
			$table->unsignedInteger('id_produk');
			$table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
		});
    }
}
