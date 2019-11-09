<?php

namespace App\Http\Controllers\Eks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Peraturan;
use App\Models\Katalog;
use App\Models\Produk;
use App\Models\CMS;
use App\Models\Artikel;
use App\Models\Buku;
use App\Models\WebStatistic;
use Response;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
		$peraturan = Peraturan::all();
		$katalog = Katalog::all();
		return view('eks.welcome', compact('peraturan','katalog'));
    }
    public function cms_about(Request $request)
    {
		try{
			$get = CMS::first();
			$totalVisit = WebStatistic::selectRaw('distinct session_id, ip ')->whereRaw('session_id is not null and session_id != \'\'')->get()->count();
			$totalVisitToday = WebStatistic::selectRaw('distinct session_id, ip')->whereRaw('session_id is not null and session_id != \'\'')->whereDate('created_at', Carbon::today())->get()->count();
			$totalVisitYesterday = WebStatistic::selectRaw('distinct session_id, ip')->whereRaw('session_id is not null and session_id != \'\'')->whereDate('created_at', Carbon::yesterday())->get()->count();
			$totalDownload = Dokumen::selectRaw('sum(download) download')->first()->download;
			
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		return response()->success('Success', [$get,$totalVisit,$totalVisitToday,$totalVisitYesterday, $totalDownload]);
    }
	
	public function artikel(Request $request)
	{
		try {
			$limit = $request->input('limit', 5);
			$get = Artikel::paginate($limit);
			$link = view('eks.artikelPagiLinks', compact('get'))->render();
			foreach($get as $k=>$data){
				$get[$k]['html'] = view('eks.artikelItem', compact('data'))->render();
			}
			
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
		return response()->success('Success', [$get,$link]);
	}
	
	public function buku(Request $request)
	{
		try {
			$limit = $request->input('limit', 5);
			$get = Buku::paginate($limit);
			$link = view('eks.bukuPagiLinks', compact('get'))->render();
			foreach($get as $k=>$data){
				$get[$k]['html'] = view('eks.bukuItem', compact('data'))->render();
			}
			
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
		return response()->success('Success', [$get,$link]);
	}
	
	public function search(Request $request)
	{
		try {
			$limit = $request->input('limit', 5);
			$get = Dokumen::with('peraturan','katalog')->search($request)->paginate($limit);
			$link = view('eks.peraturanPagiLinks', compact('get'))->render();
			foreach($get as $k=>$data){
				$get[$k]['html'] = view('eks.searchItem', compact('data'))->render();
			}
			
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
		return response()->success('Success', [$get,$link]);
	}
	
	public function daftar_produk_hukum(Request $request)
	{
		try {
			$get = Produk::orderBy('created_at','asc')->get();
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
		return response()->success('Success', $get);
	}
	
	public function anotasi(Request $request)
	{
		try {
			$get = Produk::find($request->input('id'));
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
		return response()->success('Success', $get);
	}
	
	public function download_anotasi($id, $file)
	{
		try {
		$getfile= public_path(). "/uploads/product/$id/$file";

		$headers = [];
			return Response::download($getfile, clean($file), $headers);
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
	}
	
	public function download($id, $file)
	{
		$getfile= public_path(). "/uploads/$id/$file";

		$headers = array(
				  'Content-Type: application/pdf',
				);
		
		$sql = "update dokumen set download = (coalesce(download,0)+1) where id='$id'";
		
		\DB::statement($sql);
		
		echo $sql;
		

		return Response::download($getfile, clean($file), $headers);
	}
	
	public function download_lampiran($id, $file)
	{
		try {
		$getfile= public_path(). "/uploads/$id/file_lampiran/$file";

		$headers = [];
			return Response::download($getfile, clean($file), $headers);
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		
	}
	
	
	public function artikel_detail($id)
    {
		$peraturan = Peraturan::all();
		$katalog = Katalog::all();
		$data = Artikel::find($id);
        return view('eks.blank', compact('peraturan','katalog','data'));
    }
}
