<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Buku extends Model
{
    protected $table = 'buku';
	
	protected $fillable = [
		'judul_buku',
		'sampul_buku',
		'daftarisi_buku',
		'desc_buku',
		'updated_by',
	];
	
	public function getCreatedAtAttribute($atr){
		if($atr){
			$created_at = Carbon::parse( $atr );
			return $created_at->format('d M Y - H:i');
		}
	}
}
