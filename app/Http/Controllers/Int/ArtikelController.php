<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelRequest;
use App\Models\Artikel;
use File;
use Response;

class ArtikelController extends Controller
{
    public function index(){
		$data = Artikel::get();
		return view('int.artikel.index', compact('data'));
	}
    public function add(){
		return view('int.artikel.add');
	}
    public function save(ArtikelRequest $request){
		try {
			$data = $request->all();
            $file = $request->file('sampul_artikel');		
			$random = md5(date('Ymdhis'));	
			$data['sampul_artikel'] 	= $random.'1_'.$file->getClientOriginalName(); 
			
			
			$data['updated_by'] 	= \Auth::user()->name; 
			$prod = Artikel::create($data);
			$path = public_path('uploads/artikel/'.$prod->id);
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			
			$file->move($path,$random.'1_'.$file->getClientOriginalName());
			
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
        return redirect()->route('data.artikel');
	}
	
	public function delete(Request $request){
		$id = $request->input('id');
		try {
            
			$data = Artikel::find($id);
			$data->delete();
			File::deleteDirectory(public_path('uploads/artikel/'.$id));
			
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
        return redirect()->route('data.artikel');
	}
	
	public function edit($id)
	{
		try {
            
			$data = Artikel::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.artikel.edit', compact('data'));
	}
	
	public function update(ArtikelRequest $request)
	{
		try {
            $file = $request->file('sampul_artikel');
			$data = Artikel::findOrFail($request->id);
			$data->judul_artikel = $request->judul_artikel;
			$data->isi_artikel = $request->isi_artikel;
			$data->updated_by = \Auth::user()->name;
			$random = md5(date('Ymdhis'));
			$path = public_path('uploads/artikel/'.$request->id);
			if( $file ){
				File::delete($path.'/'.$data->sampul_artikel);
				$data->sampul_artikel 	= $file->getClientOriginalName();
				$file->move($path,$file->getClientOriginalName());
			}
			$data->save();
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back()->withInput($request->input());
		}
		
		\Session::flash('success', 'Berhasil mengubah data');
        return redirect()->route('data.artikel');
		
	}
	
	public function download($id, $file)
	{
		$getfile= public_path(). "/uploads/artikel/$id/$file";

		$headers = array(
				  'Content-Type: application/pdf',
				);

		return Response::download($getfile, clean($file), $headers);
	}
	
	
}
