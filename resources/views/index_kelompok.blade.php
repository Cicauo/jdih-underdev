@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/datatables_basic.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Kelola Data Kelompok (OPD)</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<a href="{{ route('data.kelompok.add') }}">
				<button type="button" class="btn bg-teal-400 btn-labeled"><b><i class="icon-plus3"></i></b> 
					Tambah Data
				</button>
			</a>
			
			<div class="pb-5"></div>
			
			@if (\Session::has('success'))
				<div class="alert alert-success no-border">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Berhasil!</span> {{ \Session::get('success') }}
				</div>
			@endif
			
			@if (\Session::has('error'))
				<div class="alert alert-warning no-border">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Terjadi kesalahan!</span> {{ \Session::get('error') }}
				</div>
			@endif
		</div>

		<table class="table datatable-basic">
			<thead>
				<tr>
					<th>Nama Kantor</th>
					<th>Bidang Kantor</th>
					<th>Jumlah No. Telp</th>
					<th class="text-center" colspan="3">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $data)
				<tr>
					<td>{{ $data->nama_kelompok }}</td>
					<td>{{ $data->deskripsi }}</td>
					<td>{{ count($data->nomor) }}</td>
					<td>
						<a href="{{ route('data.kelompok.edit', $data->id) }}">
							<button type="button" class="btn btn-info btn-xs"><i class="icon-pencil7"></i> Edit</button>
						</a>
					</td>
					<td>
						<a onclick="return confirm('Apakah anda benar ingin menghapus data ini?')" href="{{ route('data.kelompok.delete', ['id'=>$data->id]) }}">
							<button type="button" class="btn btn-info btn-xs"><i class="icon-trash"></i> Hapus</button>
						</a>
					</td>
					<td>
						<a href="{{ route('data.nomor', $data->id) }}">
							<button type="button" class="btn btn-info btn-xs"><i class="icon-address-book"></i> Daftar No. Telp</button>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- /basic datatable -->


@endsection