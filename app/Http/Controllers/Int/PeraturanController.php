<?php

namespace App\Http\Controllers\Int;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Peraturan;

class PeraturanController extends Controller
{
    public function index(){
		$data = Peraturan::orderBy('id','desc')->get();
		return view('int.peraturan.index', compact('data'));
	}
    public function add(){
		return view('int.peraturan.add');
	}
    public function save(Request $request){
		try {
            
			Peraturan::create($request->all()+['updated_by'=>\Auth::user()->name]);
			
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
        return redirect()->route('data.peraturan');
	}
	
	public function delete(Request $request){
		$id = $request->input('id');
		try {
            
			$data = Peraturan::find($id);
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
        return redirect()->route('data.peraturan');
	}
	
	public function edit($id)
	{
		try {
            
			$data = Peraturan::find($id);
			
			
		}catch (\Throwable $e) {
            $msg = 'Terjadi kesalahan pada backend ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $msg = 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages ->'.$e->getMessage();
			\Session::flash('error', $msg);
            return redirect()->back();
		}
		return view('int.peraturan.edit', compact('data'));
	}
	
	public function update(Request $request)
	{
		try {
            
			$data = Peraturan::findOrFail($request->id);
			$data->nama_peraturan = $request->nama_peraturan;
			$data->desc_peraturan = $request->desc_peraturan;
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
        return redirect()->route('data.peraturan');
		
	}
}
