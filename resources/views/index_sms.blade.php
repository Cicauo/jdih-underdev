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
			<h5 class="panel-title">Data SMS</h5>
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
					Kirim SMS
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
					<th>No.</th>
					<th>Tujuan</th>
					<th>Pesan</th>
					<th>Status</th>
					<th>ID SMS</th>
					<th>Ket.</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $k=>$data)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $data->to }}</td>
					<td>{{ substr($data->body,0,50).'....' }}</td>
					<td>@if($data->status==1) <span class="label bg-success">Terkirim</span> @else <span class="label bg-danger">Tidak</span> @endif</td>
					<td>{{ $data->message_id }}</td>
					<td>
					{{ $data->desc }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- /basic datatable -->


@endsection