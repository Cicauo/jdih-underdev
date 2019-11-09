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
			<h5 class="panel-title">Data Campaign SMS</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<a href="{{ route('sms.create') }}">
				<button type="button" class="btn bg-teal-400 btn-labeled"><b><i class="icon-plus3"></i></b> 
					Kirim Campaign SMS
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
					{{ \Session::get('error') }}
				</div>
			@endif
		</div>

		<table class="table datatable-basic">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Perihal</th>
					<th>Tujuan (Bidang Kantor)</th>
					<th>Isi SMS</th>
					<th>Jumlah Penerima</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $k=>$data)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ date_format($data->created_at,'d-m-Y H:i') }}</td>
					<td>{{ $data->perihal }}</td>
					<td>{{ $data->kelompok->nama_kelompok }} - {{ $data->kelompok->deskripsi }}</td>
					<td>{{ $data->campaign_text }}</td>
					<td>{{ $data->jumlah_sms }}</td>
					<td>
						<a href="{{ route('sms.list', $data->id) }}">
							<button type="button" class="btn btn-info btn-xs">
								<i class="icon-eye2"></i> Detail
							</button>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- /basic datatable -->


@endsection