@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/wysihtml5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/toolbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/parsers.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/jgrowl.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_layouts.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
<form method="POST" action="{{ route('data.buku.update') }}"  enctype="multipart/form-data">
	@csrf
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Form Edit Buku</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			
			@if (\Session::has('error'))
				<div class="alert alert-warning no-border">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Terjadi kesalahan!</span> {{ \Session::get('error') }}
				</div>
			@endif
			
			<input type="hidden" name="id" value="{{ $data->id }}"/>
			
			<div class="form-group">
				<label>Judul Buku:</label>
				<input type="text" name="judul_buku" value="{{ old('judul_buku') ?: $data->judul_buku }}" required class="form-control" placeholder="Nama Produk">
				@if ($errors->has('judul_buku'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('judul_buku') }}</span>
				@endif
			</div>
			
			<div class="form-group file_exist @if($errors->has('sampul_buku')) has-error has-feedback @endif">
				<input type="hidden" name="file_exist" value="true">
				<label>Sampul Buku: <span class="text-danger"></span></label>
				<div class="media-left media-middle">
					<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
						<span class="icon-file-pdf"></span>
					</a>
				</div>
				{{ $data->sampul_buku }}
				<a class="btn-link text-danger delete_file_exist">Hapus</a>
				
				@if ($errors->has('sampul_buku'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('sampul_buku') }}</span>
				@else
					<span class="help-block">Format: pdf. Ukuran max file 2Mb</span>
				@endif
			</div>
			
			<div style="display:none;" class="file_not_exist form-group @if($errors->has('sampul_buku')) has-error has-feedback @endif">
				<label>File:</label>
				<input type="file" name="sampul_buku" class="file-styled">
				@if ($errors->has('sampul_buku'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('sampul_buku') }}</span>
				@endif
				<a class="btn-link text-info undo_delete_file_exist">Undo <i class="icon-file-pdf"></i></a>
			</div>
			
			
			<div class="form-group file_exist2 @if($errors->has('daftarisi_buku')) has-error has-feedback @endif">
				<input type="hidden" name="file_exist" value="true">
				<label>Daftar Isi: <span class="text-danger"></span></label>
				<div class="media-left media-middle">
					<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
						<span class="icon-file-pdf"></span>
					</a>
				</div>
				{{ $data->daftarisi_buku }}
				<a class="btn-link text-danger delete_file_exist2">Hapus</a>
				
				@if ($errors->has('daftarisi_buku'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('daftarisi_buku') }}</span>
				@else
					<span class="help-block">Format: pdf. Ukuran max file 2Mb</span>
				@endif
			</div>
			
			<div style="display:none;" class="file_not_exist2 form-group @if($errors->has('daftarisi_buku')) has-error has-feedback @endif">
				<label>File:</label>
				<input type="file" name="daftarisi_buku" class="file-styled">
				@if ($errors->has('daftarisi_buku'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('daftarisi_buku') }}</span>
				@endif
				<a class="btn-link text-info undo_delete_file_exist2">Undo <i class="icon-file-pdf"></i></a>
			</div>
			
			<div class="form-group">
				<label>Deskripsi:</label>
				<textarea rows="5" cols="5" class="wysihtml5 wysihtml5-min form-control" placeholder="Masukkan deskripsi" name="desc_buku">{{ old('desc_buku') ?: $data->desc_buku }}</textarea>
				@if ($errors->has('desc_produk'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('desc_buku') }}</span>
				@endif
			</div>
			
			<div class="text-right">
				<a href="{{ route('data.buku') }}" class="btn btn-link">Kembali ke Daftar</a>
				<button type="submit" class="btn btn-primary">Simpan <i class="icon-arrow-right14 position-right"></i></button>
			</div>
			
		</div>

	</div>
</form>

@endsection

@section('my_script')
<script>

$(document).ready(function(){
	$('.wysihtml5-min').wysihtml5({
		parserRules:  wysihtml5ParserRules,
		"font-styles": true, // Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, // Italics, bold, etc. Default true
		"lists": true, // (Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, // Button which allows you to edit the generated HTML. Default false
		"link": true, // Button to insert a link. Default true
		"image": false, // Button to insert an image. Default true,
		"action": false, // Undo / Redo buttons,
		"color": true // Button to change color of font
	});

	$('.select-search').select2();
	
	$('.delete_file_exist').click(function(){
		$('.file_not_exist').css('display','block');
		$('.file_exist').css('display','none');
		return false;
	});
	
	$('.undo_delete_file_exist').click(function(){
		$('.file_not_exist').css('display','none');
		$('.file_exist').css('display','block');
		return false;
	});
	
	$('.delete_file_exist2').click(function(){
		$('.file_not_exist2').css('display','block');
		$('.file_exist2').css('display','none');
		return false;
	});
	
	$('.undo_delete_file_exist2').click(function(){
		$('.file_not_exist2').css('display','none');
		$('.file_exist2').css('display','block');
		return false;
	});
});


</script>
@endsection