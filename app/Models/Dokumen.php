<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Dokumen extends Model
{
    protected $table = 'dokumen';
	
	protected $fillable = [
		'id_peraturan',
		'id_katalog',
		'nama_dokumen',
		'nomor_dokumen',
		'file_dokumen',
		'tahun_dokumen',
		'berlaku',
		'desc_dokumen',
		'abstrak',
		'mencabut',
		'dicabut',
		'ditetapkan',
		'disahkan',
		'lembaran_negara',
		'berita_negara',
		'download',
		'download',
		'updated_by',
		'file_lampiran',
	];
	
	protected $appends = ['tgl_create','pdf_url','id_dicabut'];
	
	protected $casts = [
        'mencabut' => 'array',
        'file_lampiran' => 'array',
    ];
	
	public function scopeSearch($query, Request $request): \Illuminate\Database\Eloquent\Builder
    {
		$id_peraturan     	= $request->input('id_peraturan');
        $id_katalog       	= $request->input('id_katalog');
        $nomor_dokumen   	= $request->input('nomor_dokumen');
        $tahun_dokumen      = $request->input('tahun_dokumen');
        $key              	= $request->input('key');
		
		if ($id_peraturan) {
            $query->where('id_peraturan', $id_peraturan);
        }
		if ($id_katalog) {
            $query->where('id_katalog', $id_katalog);
        }
		if ($nomor_dokumen) {
            $query->whereRaw(' nomor_dokumen::varchar ilike \'%'.$nomor_dokumen.'%\' ');
            // $query->where('nomor_dokumen',$nomor_dokumen);
        }
		if ($tahun_dokumen) {
            $query->whereRaw(' CAST(tahun_dokumen AS TEXT) ilike \'%'.$tahun_dokumen.'%\' ');
        }
		if ($key) {
            $query->whereRaw(' ( desc_dokumen ilike \'%'.$key.'%\' or abstrak ilike \'%'.$key.'%\' ) ');
        }
		$query->orderBy('tahun_dokumen','desc');
		$query->orderBy('nomor_dokumen','desc');
		return $query;
	}
	
	public function getTglCreateAttribute(){
		if(isset($this->getOriginal()['created_at'])){
			$created_at = Carbon::parse( $this->getOriginal()['created_at'] );
			return 'Tanggal '.$created_at->format('d/m/Y');
		}
		
	}
	
	public function getPdfUrlAttribute(){
		
		return asset('uploads/'.$this->id.'/'.$this->file_dokumen);
		
	}
	
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
	
	public function getDicabutAttribute($atr){
		if($atr){
			$dis = static::with('peraturan')->find($atr);
			return $dis['peraturan']['nama_peraturan'].' Nomor '.$dis['nomor_dokumen'].' Tahun '.$dis['tahun_dokumen'];
		}
	}
	
	public function getIdDicabutAttribute($atr){
		return $this->getOriginal()['dicabut'];
	}
	
	public function peraturan()
	{
		return $this->belongsTo('App\Models\Peraturan', 'id_peraturan');
	}
	
	public function katalog()
	{
		return $this->belongsTo('App\Models\Katalog', 'id_katalog');
	}
	
	public function mcabut()
	{
		return null;
		// return $this->hasOne('App\Models\Dokumen', 'mencabut','id');
	}
	
	// public function dcabut()
	// {
		// return $this->hasOne('App\Models\Dokumen', 'dicabut','id');
	// }
}
