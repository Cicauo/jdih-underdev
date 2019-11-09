<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use File;

class ProdukController extends Controller
{
    public function index(){
		$data = Produk::get();
		return view('int.produk.index', compact('data'));
	}
    public function add(){
		return view('int.produk.add');
	}
    public function save(ProdukRequest $request){
		try {
			$data = $request->all();
            $file = $request->file('file_produk');
			
			$data['file_produk'] 	= $file->getClientOriginalName(); 
			$data['updated_by'] 	= \Auth::user()->name; 
			$prod = Produk::create($data);
			$path = public_path('uploads/product/'.$prod->id);
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			
			$file->move($path,$file->getClientOriginalName());
			
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
        return redirect()->route('data.produk');
	}
	
	public function delete(Request $request){
		$id = $request->input('id');
		try {
            
			$data = Produk::find($id);
			$data->delete();
			File::deleteDirectory(public_path('uploads/product/'.$id));
			
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
        return redirect()->route('data.produk');
	}
	
	public function edit($id)
	{
		try {
            
			$data = Produk::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.produk.edit', compact('data'));
	}
	
	public function update(ProdukRequest $request)
	{
		try {
            $file = $request->file('file_produk');
			$data = Produk::findOrFail($request->id);
			$data->nama_produk = $request->nama_produk;
			$data->desc_produk = $request->desc_produk;
			$data->updated_by = \Auth::user()->name;
			
			$path = public_path('uploads/product/'.$request->id);
			if( $file ){
				\Log::info('start OKE');
				\Log::info($path.'/'.$data->file_produk);
				File::delete($path.'/'.$data->file_produk);
				$data->file_produk 	= $file->getClientOriginalName();
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
        return redirect()->route('data.produk');
		
	}
	
	public function download($id, $file)
	{
		$getfile= public_path(). "/uploads/product/$id/$file";

		$headers = array(
				  'Content-Type: application/pdf',
				);

		return Response::download($getfile, clean($file), $headers);
	}
	
	
}
