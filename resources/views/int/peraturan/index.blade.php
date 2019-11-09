@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Data Peraturan</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<a href="{{ route('data.peraturan.add') }}">
				<button type="button" class="btn bg-teal-400 btn-labeled"><b><i class="icon-plus3"></i></b> 
					Tambah Data
				</button>
			</a>
			
			<div class="pb-5"></div>
			<div class="pb-5"></div>
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
					<th>No</th>
					<th>Nama Peraturan</th>
					<th>Deskripsi</th>
					<th>Create At</th>
					<th>Updated At</th>
					<th>Updated By</th>
					<th class="text-center" colspan="2">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $k=>$data)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $data->nama_peraturan }}</td>
					<td>{{ $data->desc_peraturan }}</td>
					<td>{{ $data->created_at }}</td>
					<td>{{ $data->updated_at }}</td>
					<td>{{ $data->updated_by }}</td>
					<td>
						<a href="{{ route('data.peraturan.edit', $data->id) }}">
							<button type="button" class="btn btn-info btn-xs"><i class="icon-pencil7"></i> Edit</button>
						</a>
					</td>
					<td>
						<a onclick="return confirm('Apakah anda benar ingin menghapus data ini?')" href="{{ route('data.peraturan.delete', ['id'=>$data->id]) }}">
							<button type="button" class="btn btn-info btn-xs"><i class="icon-trash"></i> Hapus</button>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- /basic datatable -->


@endsection

@section('my_script')
<script>
$(document).ready(function() {
	
	$('.datatable-basic').DataTable( {
		responsive: true
	} );
} );
</script>
@endsection