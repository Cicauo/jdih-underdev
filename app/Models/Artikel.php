<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Artikel extends Model
{
    protected $table = 'artikel';
	
	protected $fillable = [
		'judul_artikel',
		'sampul_artikel',
		'isi_artikel',
		'updated_by',
	];
	
	public function getCreatedAtAttribute($atr){
		if($atr){
			$created_at = Carbon::parse( $atr );
			return $created_at->format('d M Y - H:i');
		}
	}
}
