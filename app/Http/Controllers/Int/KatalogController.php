<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Katalog;

class KatalogController extends Controller
{
    public function index(){
		$data = Katalog::get();
		return view('int.katalog.index', compact('data'));
	}
    public function add(){
		return view('int.katalog.add');
	}
    public function save(Request $request){
		try {
            
			Katalog::create($request->all()+['updated_by'=>\Auth::user()->name]);
			
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
        return redirect()->route('data.katalog');
	}
	
	public function delete(Request $request){
		$id = $request->input('id');
		try {
            
			$data = Katalog::find($id);
			$data->delete();
			
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
        return redirect()->route('data.katalog');
	}
	
	public function edit($id)
	{
		try {
            
			$data = Katalog::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.katalog.edit', compact('data'));
	}
	
	public function update(Request $request)
	{
		try {
            
			$data = Katalog::findOrFail($request->id);
			$data->nama_katalog = $request->nama_katalog;
			$data->desc_katalog = $request->desc_katalog;
			$data->updated_by = \Auth::user()->name;
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
        return redirect()->route('data.katalog');
		
	}
}
