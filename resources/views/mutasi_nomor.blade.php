@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_layouts.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_select2.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
<form method="POST" action="{{ route('data.nomor.mutasikan') }}">
	@csrf
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Mutasi Pegawai</h6>
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
				<label>Nama pegawai:</label>
				<input type="text" value="{{ $data->nama_anggota }}" readonly class="form-control"/>
			</div>
			<div class="form-group">
				<label>NIP:</label>
				<input type="text" value="{{ $data->nip }}" readonly class="form-control"/>
			</div>
			<div class="form-group">
				<label>Kantor / Bagian:</label>
				<select name="id_kelompok" id="" class="select-search">
					<option value="">-- Pilih --</option>
					@foreach($kelompok as $klp)
					<option value="{{ $klp->id }}" @if($klp->id == $data->id_kelompok) selected="selected" @endif> {{ $klp->nama_kelompok }} - {{ $klp->deskripsi }} </option>
					@endforeach
				</select>
			</div>
			
			
			
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Simpan <i class="icon-arrow-right14 position-right"></i></button>
			</div>
			
		</div>

	</div>
</form>

@endsection