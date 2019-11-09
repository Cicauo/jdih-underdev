<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use App\Models\Buku;
use File;
use Response;

class BukuController extends Controller
{
    public function index(){
		$data = Buku::get();
		return view('int.buku.index', compact('data'));
	}
    public function add(){
		return view('int.buku.add');
	}
    public function save(BukuRequest $request){
		try {
			$data = $request->all();
            $file = $request->file('sampul_buku');		
			$random = md5(date('Ymdhis'));	
			$data['sampul_buku'] 	= $random.'1_'.$file->getClientOriginalName(); 
			
            $file2 = $request->file('daftarisi_buku');			
			$data['daftarisi_buku'] 	= $random.'2_'.$file2->getClientOriginalName(); 
			
			$data['updated_by'] 	= \Auth::user()->name; 
			$prod = Buku::create($data);
			$path = public_path('uploads/buku/'.$prod->id);
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			
			$file->move($path,$random.'1_'.$file->getClientOriginalName());
			$file2->move($path,$random.'2_'.$file2->getClientOriginalName());
			
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
        return redirect()->route('data.buku');
	}
	
	public function delete(Request $request){
		$id = $request->input('id');
		try {
            
			$data = Buku::find($id);
			$data->delete();
			File::deleteDirectory(public_path('uploads/buku/'.$id));
			
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
        return redirect()->route('data.buku');
	}
	
	public function edit($id)
	{
		try {
            
			$data = Buku::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.buku.edit', compact('data'));
	}
	
	public function update(BukuRequest $request)
	{
		try {
            $file = $request->file('sampul_buku');
            $file2 = $request->file('daftarisi_buku');
			$data = Buku::findOrFail($request->id);
			$data->judul_buku = $request->judul_buku;
			$data->desc_buku = $request->desc_buku;
			$data->updated_by = \Auth::user()->name;
			$random = md5(date('Ymdhis'));
			$path = public_path('uploads/buku/'.$request->id);
			if( $file ){
				File::delete($path.'/'.$data->sampul_buku);
				$data->sampul_buku 	= $file->getClientOriginalName();
				$file->move($path,$file->getClientOriginalName());
			}
			if( $file2 ){
				File::delete($path.'/'.$data->daftarisi_buku);
				$data->daftarisi_buku 	= $file2->getClientOriginalName();
				$file2->move($path,$file2->getClientOriginalName());
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
        return redirect()->route('data.buku');
		
	}
	
	public function download($id, $file)
	{
		$getfile= public_path(). "/uploads/buku/$id/$file";

		$headers = array(
				  'Content-Type: application/pdf',
				);

		return Response::download($getfile, clean($file), $headers);
	}
	
	
}
