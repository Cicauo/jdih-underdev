<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produk extends Model
{
    protected $table = 'produk';
	
	protected $fillable = [
		'nama_produk',
		'desc_produk',
		'file_produk',
		'updated_by',
	];
	
	protected $appends = ['download_link'];
	
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
	
	public function getDownloadLinkAttribute($atr){
		return '<a href="'.route('api.download-anotasi', [$this->id, $this->file_produk]).'"><button type="button" class="btn btn-primary">Download</button></a>';
	}
}
