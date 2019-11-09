<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Katalog extends Model
{
    protected $table = 'katalog';
	
	protected $fillable = [
		'nama_katalog',
		'desc_katalog',
		'updated_by',
	];
	
	public function getCreatedAtAttribute($atr){
		if($atr){
			$created_at = Carbon::parse( $atr );
			return $created_at->format('d M Y - H:i');
		}
	}
	
	public function getUpdatedAtAttribute($atr){
		if($atr){
			$created_at = Carbon::parse( $atr );
			return $created_at->format('d M Y - H:i');
		}
	}
}
