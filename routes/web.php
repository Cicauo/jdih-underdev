<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return redirect()->route('welcome');
// });

Auth::routes();

Route::post('loginv2', ['as'=>'auth.login', 'uses'=>'Auth\LoginController@login']);

Route::namespace('Eks')->group(function () {
	Route::get('/', 'HomeController@index')->name('welcome');
	Route::get('/welcome', 'HomeController@index')->name('welcome');
	Route::get('/runjon', 'WebStatisticController@run')->name('wehdjnsd');
	Route::get('/artikel/{id}', 'HomeController@artikel_detail')->name('eks.artikel_detail');
	
	Route::group(['prefix'=>'api'], function () {
		Route::get('search', ['as'=>'api.search', 'uses'=>'HomeController@search']);
		Route::get('artikel', ['as'=>'api.artikel', 'uses'=>'HomeController@artikel']);
		Route::get('buku', ['as'=>'api.buku', 'uses'=>'HomeController@buku']);
		
		Route::get('download/{id}/{file}', ['as'=>'api.download', 'uses'=>'HomeController@download']);
		Route::get('download_lampiran/{id}/{file}', ['as'=>'api.download_lampiran', 'uses'=>'HomeController@download_lampiran']);
		Route::get('daftar_produk_hukum', ['as'=>'api.daftar_produk_hukum', 'uses'=>'HomeController@daftar_produk_hukum']);
		Route::get('cms_about', ['as'=>'api.cms.about', 'uses'=>'HomeController@cms_about']);
		Route::post('store_visitor', ['as'=>'api.store_visitor', 'uses'=>'WebStatisticController@store_visitor']);
		Route::get('anotasi', ['as'=>'api.anotasi', 'uses'=>'HomeController@anotasi']);
		Route::get('download-anotasi/{id}/{file}', ['as'=>'api.download-anotasi', 'uses'=>'HomeController@download_anotasi']);
	});
});


Route::namespace('Int')->group(function () {
	
	Route::group(['middleware' => [ 'auth' ]], function () {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/home/dashboard', 'HomeController@dashboard')->name('dashboard');
		
		Route::group(['prefix'=>'data'], function () {
			
			
			Route::group(['prefix'=>'peraturan'], function () {
				Route::get('/', ['as'=>'data.peraturan', 'uses'=>'PeraturanController@index']);
				Route::get('add', ['as'=>'data.peraturan.add', 'uses'=>'PeraturanController@add']);
				Route::post('save', ['as'=>'data.peraturan.save', 'uses'=>'PeraturanController@save']);
				Route::get('delete', ['as'=>'data.peraturan.delete', 'uses'=>'PeraturanController@delete']);
				Route::get('edit/{id}', ['as'=>'data.peraturan.edit', 'uses'=>'PeraturanController@edit']);
				Route::post('update', ['as'=>'data.peraturan.update', 'uses'=>'PeraturanController@update']);
			});	
			
			Route::group(['prefix'=>'katalog'], function () {
				Route::get('/', ['as'=>'data.katalog', 'uses'=>'KatalogController@index']);
				Route::get('add', ['as'=>'data.katalog.add', 'uses'=>'KatalogController@add']);
				Route::post('save', ['as'=>'data.katalog.save', 'uses'=>'KatalogController@save']);
				Route::get('delete', ['as'=>'data.katalog.delete', 'uses'=>'KatalogController@delete']);
				Route::get('edit/{id}', ['as'=>'data.katalog.edit', 'uses'=>'KatalogController@edit']);
				Route::post('update', ['as'=>'data.katalog.update', 'uses'=>'KatalogController@update']);
			});	
			
			Route::group(['prefix'=>'produk'], function () {
				Route::get('/', ['as'=>'data.produk', 'uses'=>'ProdukController@index']);
				Route::get('add', ['as'=>'data.produk.add', 'uses'=>'ProdukController@add']);
				Route::post('save', ['as'=>'data.produk.save', 'uses'=>'ProdukController@save']);
				Route::get('delete', ['as'=>'data.produk.delete', 'uses'=>'ProdukController@delete']);
				Route::get('edit/{id}', ['as'=>'data.produk.edit', 'uses'=>'ProdukController@edit']);
				Route::post('update', ['as'=>'data.produk.update', 'uses'=>'ProdukController@update']);
				Route::get('download/{id}/{file}', ['as'=>'data.produk.download', 'uses'=>'ProdukController@download']);
			});	
			
			Route::group(['prefix'=>'dokumen'], function () {
				Route::get('/', ['as'=>'data.dokumen', 'uses'=>'DokumenController@index']);
				Route::get('add', ['as'=>'data.dokumen.add', 'uses'=>'DokumenController@add']);
				Route::post('save', ['as'=>'data.dokumen.save', 'uses'=>'DokumenController@save']);
				Route::get('delete/{id}', ['as'=>'data.dokumen.delete', 'uses'=>'DokumenController@delete']);
				Route::get('edit/{id}', ['as'=>'data.dokumen.edit', 'uses'=>'DokumenController@edit']);
				Route::post('update', ['as'=>'data.dokumen.update', 'uses'=>'DokumenController@update']);
				Route::get('json', ['as'=>'data.dokumen.json', 'uses'=>'DokumenController@json']);
				Route::get('detail/{id}', ['as'=>'data.dokumen.detail', 'uses'=>'DokumenController@detail']);
				Route::get('download/{id}/{file}', ['as'=>'data.dokumen.download', 'uses'=>'DokumenController@download']);
				Route::get('download_lampiran/{id}/{file}', ['as'=>'data.dokumen.download_lampiran', 'uses'=>'DokumenController@download_lampiran']);
			});				
			
			Route::group(['prefix'=>'buku'], function () {
				Route::get('/', ['as'=>'data.buku', 'uses'=>'BukuController@index']);
				Route::get('add', ['as'=>'data.buku.add', 'uses'=>'BukuController@add']);
				Route::post('save', ['as'=>'data.buku.save', 'uses'=>'BukuController@save']);
				Route::get('delete', ['as'=>'data.buku.delete', 'uses'=>'BukuController@delete']);
				Route::get('edit/{id}', ['as'=>'data.buku.edit', 'uses'=>'BukuController@edit']);
				Route::post('update', ['as'=>'data.buku.update', 'uses'=>'BukuController@update']);
				Route::get('download/{id}/{file}', ['as'=>'data.buku.download', 'uses'=>'BukuController@download']);
			});				
			
			Route::group(['prefix'=>'artikel'], function () {
				Route::get('/', ['as'=>'data.artikel', 'uses'=>'ArtikelController@index']);
				Route::get('add', ['as'=>'data.artikel.add', 'uses'=>'ArtikelController@add']);
				Route::post('save', ['as'=>'data.artikel.save', 'uses'=>'ArtikelController@save']);
				Route::get('delete', ['as'=>'data.artikel.delete', 'uses'=>'ArtikelController@delete']);
				Route::get('edit/{id}', ['as'=>'data.artikel.edit', 'uses'=>'ArtikelController@edit']);
				Route::post('update', ['as'=>'data.artikel.update', 'uses'=>'ArtikelController@update']);
				Route::get('download/{id}/{file}', ['as'=>'data.artikel.download', 'uses'=>'ArtikelController@download']);
			});	
		
		});
		Route::group(['prefix'=>'cms'], function () {
			Route::get('/about', ['as'=>'cms.about', 'uses'=>'HomeController@about']);
			Route::post('/about_update', ['as'=>'cms.about.update', 'uses'=>'HomeController@about_update']);
			
			Route::get('/address', ['as'=>'cms.address', 'uses'=>'HomeController@address']);
			Route::post('/address_update', ['as'=>'cms.address.update', 'uses'=>'HomeController@address_update']);
			
			Route::get('/slider', ['as'=>'cms.slider', 'uses'=>'HomeController@slider']);
			Route::post('/slider_update', ['as'=>'cms.slider.update', 'uses'=>'HomeController@slider_update']);
			
			Route::get('/banner', ['as'=>'cms.banner', 'uses'=>'HomeController@banner']);
			Route::post('/banner_update', ['as'=>'cms.banner.update', 'uses'=>'HomeController@banner_update']);
		});	
	});
});


