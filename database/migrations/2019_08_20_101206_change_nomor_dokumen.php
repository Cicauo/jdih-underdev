<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNomorDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen', function (Blueprint $table) {
			\DB::statement('ALTER TABLE dokumen ALTER COLUMN nomor_dokumen  TYPE integer USING (nomor_dokumen::integer);');
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
			\DB::statement('ALTER TABLE dokumen ALTER COLUMN nomor_dokumen  TYPE varchar USING (nomor_dokumen::varchar);');
		});
    }
}
