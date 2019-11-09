<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Dokumen;
use App\Models\Peraturan;
use App\Models\WebStatistic;
use Carbon\Carbon;
use App\Http\Requests\BannerRequest;
use DB;
use File;

class HomeController extends Controller
{
    public function index()
    {
        return view('int.home.index');
    }
    public function about()
    {
		$data = CMS::first();
        return view('int.home.about', compact('data'));
    }
    public function about_update(Request $request)
    {
        try {
			$get = CMS::firstOrCreate($request->only('id'),$request->only('about'));
			if($request->id){
				$get->about = $request->about;
				$get->save();
			}
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
		}
		
		\Session::flash('success', 'Berhasil menyimpan data');
        return redirect()->route('cms.about');
    }
	
	public function dashboard()
	{
		try {
			$berlaku = Dokumen::where('berlaku',true)->get()->count();
			$tdkBerlaku = Dokumen::where('berlaku',false)->get()->count();
			$totalPeraturan = Dokumen::all()->count();
			$totalVisit = WebStatistic::selectRaw('distinct session_id, ip ')->whereRaw('session_id is not null and session_id != \'\'')->get()->count();
			$totalVisitToday = WebStatistic::selectRaw('distinct session_id, ip')->whereRaw('session_id is not null and session_id != \'\'')->whereDate('created_at', Carbon::today())->get()->count();
			$totalVisitYesterday = WebStatistic::selectRaw('distinct session_id, ip')->whereRaw('session_id is not null and session_id != \'\'')->whereDate('created_at', Carbon::yesterday())->get()->count();
			$latestVisitor = WebStatistic::take(10)->orderBy('created_at','asc')->whereRaw('session_id is not null and session_id != \'\'')->get();
			$jenisPeraturan = Dokumen::selectRaw('id_peraturan,nama_peraturan, count(id_peraturan) jml')
										->rightJoin('peraturan','peraturan.id','=','dokumen.id_peraturan')
										->groupBy('id_peraturan','nama_peraturan')
										->orderBy('jml','desc')
										->get();
			$berlakuTidak = Dokumen::selectRaw(' berlaku, count(id) as jml ')->groupBy('berlaku')->get();
			$dataPeruser = Dokumen::selectRaw(' updated_by, count(id) as jml ')->groupBy('updated_by')->get();
			
			$totalVisitYesterday = $totalVisitYesterday ?: 1;
			$totalVisitToday = $totalVisitToday ?: 1;
			
			if($totalVisitYesterday > $totalVisitToday){
				$perc = $totalVisitYesterday/$totalVisitToday;
				$todayVisit = number_format($totalVisitToday).' <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (-'.$perc.')</small>';
			}else if($totalVisitYesterday < $totalVisitToday){
				$perc = $totalVisitToday/$totalVisitYesterday;
				$todayVisit = number_format($totalVisitToday).' <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+'.$perc.')</small>';
			}else{
				$perc = $totalVisitToday/$totalVisitYesterday;
				$todayVisit = number_format($totalVisitToday).' <small class="text-default text-size-base"><i class=""></i> ('.$perc.')</small>';
			
			}
			
			$tr = '';
			foreach($latestVisitor as $lv){
				$tr .= '
					<tr>
						<td>
							<div class="media-left">
								<div class=""><a href="#" class="text-default text-semibold">'.$lv['ip'].'</a></div>
								
							</div>
						</td>
						<td><span class="text-muted">'.$lv['browser'].'</span></td>
						<td><span class="text-muted">'.$lv['device_type'].'</span></td>
						<td><span class="text-muted">'.$lv['os'].'</span></td>
						<td><span class="text-muted">'.$lv['ref_url_name'].'</span></td>
						<td><span class="text-muted">'.$lv['created_at'].'</span></td>
						
					</tr>
				';	
			}
			$tr2='';
			foreach($jenisPeraturan as $jp){
				$tr2 .= '
					<tr>
						<td>
							<div class="media-left media-middle">
								<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
									<span class="letter-icon"></span>
								</a>
							</div>

							<div class="media-body">
								<div class="media-heading">
									<a href="#" class="letter-icon-title">'.$jp['nama_peraturan'].'</a>
								</div>

								<div class="text-muted text-size-small">Jenis Peraturan</div>
							</div>
						</td>
						<td>
							<h6 class="text-semibold no-margin text-center">'.$jp['jml'].'</h6>
						</td>
						<td>
							<h6 class="text-semibold no-margin text-center">'.cek_berlaku_by_jenis_peraturan($jp['id_peraturan']).'</h6>
						</td>
						<td>
							<h6 class="text-semibold no-margin text-center">'.cek_tidak_berlaku_by_jenis_peraturan($jp['id_peraturan']).'</h6>
						</td>
					</tr>
				';	
			}
			
			$tr3='';
			foreach($berlakuTidak as $bt){
				$status = $bt['berlaku'] ? 'Berlaku' : 'Tidak Berlaku';
				$icon = $bt['berlaku'] ? 'icon-checkmark3' : 'icon-cross2';
				$style = $bt['berlaku'] ? 'btn border-success text-success btn-flat btn-rounded btn-icon btn-xs' : 'btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs';
				$tr3 .= '
					<tr>
						<td>
							<div class="media-left media-middle">
								<a href="#" class="btn '.$style.' btn-rounded btn-icon btn-xs">
									<span class="'.$icon.'"></span>
								</a>
							</div>

							<div class="media-body">
								<div class="media-heading">
									<a href="#" class="letter-icon-title">'.$status.'</a>
								</div>

								<div class="text-muted text-size-small">Status Peraturan</div>
							</div>
						</td>
						<td>
							<h6 class="text-semibold no-margin text-center">'.$bt['jml'].'</h6>
						</td>
					</tr>
				';	
			}
			
			$tr4='';
			foreach($dataPeruser as $bt){
				$updated_by = $bt['updated_by'];
				$style = 'btn border-success-400 text-success-400 btn-flat btn-rounded btn-icon btn-xs';
				$tr4 .= '
					<tr>
						<td>
							<div class="media-left media-middle">
								<a href="#" class="'.$style.'">
									<span class="letter-icon"></span>
								</a>
							</div>

							<div class="media-body">
								<div class="media-heading">
									<a href="#" class="letter-icon-title">'.$updated_by.'</a>
								</div>

								<div class="text-muted text-size-small">Status Peraturan</div>
							</div>
						</td>
						<td>
							<h6 class="text-semibold no-margin text-center">'.$bt['jml'].'</h6>
						</td>
					</tr>
				';	
			}
			
			$data = [
				'berlaku'				=> number_format($berlaku),
				'tdkBerlaku'			=> number_format($tdkBerlaku),
				'totalPeraturan'		=> number_format($totalPeraturan),
				'totalVisit'			=> ($totalVisit),
				'todayVisit'			=> ($todayVisit),
				'yesterdayVisit'		=> ($totalVisitYesterday),
				'latestVisitor'			=> ($tr),
				'jenisPeraturan'		=> ($tr2),
				'berlakuTidak'			=> ($tr3),
				'dataPeruser'			=> ($tr4),
			];
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		return response()->success('Success', $data);
	}
	
	
    public function address()
    {
		$data = CMS::first();
        return view('int.home.address', compact('data'));
    }
	
	public function address_update(Request $request)
    {
        try {
			$get = CMS::firstOrCreate($request->only('id'),$request->only('address'));
			if($request->id){
				$get->address = $request->address;
				$get->save();
			}
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
		}
		
		\Session::flash('success', 'Berhasil menyimpan data');
        return redirect()->route('cms.address');
    }
	
    public function slider()
    {
		$data = CMS::first();
        return view('int.home.slider', compact('data'));
    }
	
	public function slider_update(Request $request)
    {
        try {
			$get = CMS::firstOrCreate($request->only('id'),$request->only('slider1','slider2','slider3'));
			if($request->id){
				$get->slider1 = $request->slider1;
				$get->slider2 = $request->slider2;
				$get->slider3 = $request->slider3;
				$get->save();
			}
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
		}
		
		\Session::flash('success', 'Berhasil menyimpan data');
        return redirect()->route('cms.slider');
    }
	
    public function banner()
    {
		$data = CMS::first();
        return view('int.home.banner', compact('data'));
    }
	
	public function banner_update(BannerRequest $request)
    {
        try {
			DB::beginTransaction();
			$banner1 = $request->file('banner1');
			$banner2 = $request->file('banner2');
			$get = CMS::find($request->id);
			
			if($request->id){
				$get->banner1 = $banner1->getClientOriginalName();
				$get->banner2 = $banner2->getClientOriginalName();
				$get->save();
			}
			
			$path = public_path('uploads/cms/banner/');
			if( $banner1 ){
				$banner1->move($path,'ban1.png');
			}
			if( $banner2 ){
				$banner2->move($path,'ban2.png');
			}
		}catch (\Throwable $e) {
			DB::rollBack();
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
        }catch (\Exception $e) {
			DB::rollBack();
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
		}
		
		DB::commit();
		\Session::flash('success', 'Berhasil menyimpan data');
        return redirect()->route('cms.banner');
    }

}
