<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peraturan extends Model
{
    protected $table = 'peraturan';
	
	protected $fillable = [
		'nama_peraturan',
		'desc_peraturan',
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
