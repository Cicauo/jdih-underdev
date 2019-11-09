<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeraturanRequest;
use App\Models\Dokumen;
use App\Models\Peraturan;
use App\Models\Katalog;
use File;
use Datatables;
use URL;
use DB;
use Response;

class DokumenController extends Controller
{
    public function index(){
		
		$data = Dokumen::with('peraturan','katalog')->get();
		return view('int.dokumen.index', compact('data'));
	}
    
	public function detail($id){
		
		$data = Dokumen::with('peraturan','katalog')->find($id);
		return view('int.dokumen.modal_body', compact('data'));
	}
	
	public function download($id, $file)
	{
		$getfile= public_path(). "/uploads/$id/$file";

		$headers = array(
				  'Content-Type: application/pdf',
				);

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
	
	public function json(){
		$model = Dokumen::with('peraturan','katalog');
		
		return Datatables::eloquent($model)
			->editColumn('id_peraturan','{{ $peraturan[\'nama_peraturan\'] }}')
			->editColumn('id_katalog','{{ $katalog[\'nama_katalog\'] }}')
			->addColumn('action', '
				<ul class="icons-list">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#" onclick="show_detail({{$id}})"><i class="icon-file-pdf"></i> Lihat detail</a></li>
							<li>
								<a href="'.URL::to('data/dokumen/edit/{{ $id }}').'">
									<i class="icon-pencil7"></i> Edit
								</a>
							</li>
							<li>
								<a onclick="delete_confirm(\''.URL::to('data/dokumen/delete/{{ $id }}').'\'); return false;">
									<i class="icon-trash"></i> Hapus
								</a>
							</li>
						</ul>
					</li>
				</ul>')
			->rawColumns(['action'])
			->make(true);
    }
	
    public function add(){
		
		$peraturan = Peraturan::all();
		$katalog = Katalog::all();
		$dokumen = Dokumen::with('peraturan')->get();
		return view('int.dokumen.add', compact('peraturan','katalog','dokumen'));
	}
    
	public function save(PeraturanRequest $request){
		DB::beginTransaction();
		try {
            
			$data = $request->all();
			$file = $request->file('file_dokumen');
			$FPendukung = $request->file('file_pendukung');
			
			$data['berlaku'] 		= $request->berlaku ?? false; 
			$data['file_dokumen'] 	= $file->getClientOriginalName(); 
			$data['updated_by'] 	= \Auth::user()->name; 
			
			$data['file_lampiran'] = [];
			if($FPendukung){
				foreach( $FPendukung as $k=>$fp ){
					$data['file_lampiran'][] = $k . $fp->getClientOriginalName();
				}
			}
			
			$dmnc = [];
			$mnC = $request->mencabut;
			if($request->mencabut){
				foreach( $request->mencabut as $mnc ){
					$dfg = Dokumen::with('peraturan')->find($mnc);
					
					$dfg->berlaku = false;
					$dfg->save();					
					
					array_push($dmnc, [
						'nama_peraturan'	=> $dfg['peraturan']['nama_peraturan'],
						'nomor_dokumen'		=> $dfg['nomor_dokumen'],
						'tahun_dokumen'		=> $dfg['tahun_dokumen'],
						'idp'				=> $mnc,
					]);
				}
			}
			
			$data['mencabut'] = $dmnc;
			
			$doc = Dokumen::create($data);
			
			if($request->mencabut){
				foreach($mnC as $mnC){
					$ert = Dokumen::with('peraturan')->find($mnc);
					$ert->dicabut = $doc->id;
					$ert->save();
				}
			}
			
			$path = public_path('uploads/'.$doc->id);
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			
			$file->move($path,$file->getClientOriginalName());
			if(count($data['file_lampiran'])>0){
				File::isDirectory($path.'/file_lampiran') or File::makeDirectory($path.'/file_lampiran', 0777, true, true);
				foreach($FPendukung as $k=>$fp){
					$fp->move($path.'/file_lampiran',$k.$fp->getClientOriginalName());
				}
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
        return redirect()->route('data.dokumen');
	}
	
	public function delete($id){
		
		try {
            
			$data = Dokumen::find($id);
			$data->delete();
			File::deleteDirectory(public_path('uploads/'.$id));
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		
		\Session::flash('success', 'Berhasil menghapus data');
        return redirect()->route('data.dokumen');
	}
	
	public function edit($id)
	{
		try {
            $peraturan = Peraturan::all();
			$katalog = Katalog::all();
			$dokumen = Dokumen::with('peraturan')->where('id','!=',$id)->get();
			$data = Dokumen::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.dokumen.edit', compact('data','peraturan','katalog','dokumen'));
	}
	
	public function update(PeraturanRequest $request)
	{
		DB::beginTransaction();
		// try {
            
			$data = $request->all();
			$file = $request->file('file_dokumen');
			$FLampiran = $request->file('lampiran_dokumen');
			
			$data['berlaku'] 		= $request->berlaku ?? false; 
			if( $file ){
				$data['file_dokumen'] 	= $file->getClientOriginalName();
			}
			
			$data['file_lampiran'] = [];
			if($FLampiran){
				foreach( $FLampiran as $k=>$fp ){
					$data['file_lampiran'][] = $k . $fp->getClientOriginalName();
				}
			}
			// dd($data);
			$data['updated_by'] 	= \Auth::user()->name; 
			
			$dmnc = [];
			$mnC = $request->mencabut;
			if($request->mencabut){
				foreach( $request->mencabut as $mnc ){
					$dfg = Dokumen::with('peraturan')->find($mnc);
					
					$dfg->berlaku = false;
					$dfg->save();					
					
					array_push($dmnc, [
						'nama_peraturan'	=> $dfg['peraturan']['nama_peraturan'],
						'nomor_dokumen'		=> $dfg['nomor_dokumen'],
						'tahun_dokumen'		=> $dfg['tahun_dokumen'],
						'idp'				=> $mnc,
					]);
				}
			}
			
			$data['mencabut'] = $dmnc;
			
			$doc = Dokumen::find($request->id);
			
			foreach($doc->mencabut as $mnc){
				$ert = Dokumen::where('id',$mnc['idp'])->update([
					'dicabut'=> null,
					'berlaku'=> true,
				]);
			}
			

			$path = public_path('uploads/'.$request->id);
			
			if( $file ){
				\Log::info('start OKE');
				\Log::info($path.'/'.$doc->file_dokumen);
				File::delete($path.'/'.$doc->file_dokumen);
				$file->move($path,$file->getClientOriginalName());
			}
			
			if( $doc->file_lampiran ){
				foreach( $doc->file_lampiran as $fl ){
					File::delete($path.'/file_lampiran/'.$fl);
				}				
			}
			
			if( $FLampiran ){
				foreach( $FLampiran as $k=>$fp ){
					$fp->move($path.'/file_lampiran',$k . $fp->getClientOriginalName());
				}				
			}
			$doc->update($data);
			
			if($request->mencabut){
				foreach($mnC as $dd){
					$ert = Dokumen::find($dd);
					$ert->dicabut = $doc->id;
					$ert->save();
				}
			}
			
			
		// }catch (\Throwable $e) {
			// DB::rollBack();
            // \Session::flash('error', throwable_msg($e));
            // return redirect()->back()->withInput($request->input());
        // }catch (\Exception $e) {
			// DB::rollBack();
            // \Session::flash('error', exception_msg($e));
            // return redirect()->back()->withInput($request->input());
		// }
		
		DB::commit();
		\Session::flash('success', 'Berhasil mengubah data');
        return redirect()->route('data.dokumen');
		
	}
}
