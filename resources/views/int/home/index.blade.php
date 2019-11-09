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
	
	<div class="row">
		<div class="col-md-12 pb-5">
			<h1>Dashboard</h1>
		</div>
	</div>
	
	<!-- /basic datatable -->
	<div class="row">
		<div class="col-lg-4">

			<!-- Members online -->
			<div class="panel bg-teal-400">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>

					<h3 class="no-margin berlaku">0</h3>
					Peraturan Berlaku
				</div>

				<div class="container-fluid">
					<div id="members-online"></div>
				</div>
			</div>
			<!-- /members online -->

		</div>

		<div class="col-lg-4">

			<!-- Current server load -->
			<div class="panel bg-pink-400">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>

					<h3 class="no-margin tdkBerlaku"></h3>
					Peraturan Tidak Berlaku
				</div>

				<div id="server-load"></div>
			</div>
			<!-- /current server load -->

		</div>

		<div class="col-lg-4">

			<!-- Today's revenue -->
			<div class="panel bg-blue-400">
				<div class="panel-body">
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>

					<h3 class="no-margin totalPeraturan">0</h3>
					Total Peraturan
				</div>

				<div id="today-revenue"></div>
			</div>
			<!-- /today's revenue -->

		</div>
	</div>
			<!-- /quick stats boxes -->

	<div class="row">
		
		<div class="col-lg-6">
		
			<!-- Quick stats boxes -->
			

			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Pengunjung Website</h6>
					
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="campaigns-donut"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin todayVisit">
											
										</h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="status-mark border-success"></span>
											</li>
											<li>
												<span class="text-muted">Total Pengunjung Hari Ini</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-7">
									<div class="media-left">
										<div id="campaign-status-pie"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin totalVisit">0 </h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total Pengunjung</span>
											</li>
										</ul>
									</div>
								</td>

							</tr>
						</tbody>
					</table>	
				</div>

				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr>
								<th>IP</th>
								<th class="col-md-2">Browser</th>
								<th class="col-md-2">Device</th>
								<th class="col-md-2">Sistem Operasi</th>
								<th class="col-md-2">Referensi</th>
								<th class="col-md-2">Visit Date</th>
							</tr>
						</thead>
						<tbody class="latestVisitor">
							<tr class="active border-double">
								<td colspan="5">Today</td>
								<td class="text-right">
									<span class="progress-meter" id="today-progress" data-progress="30"></span>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Jumlah Peraturan Per User</h6>
					
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody class="dataPeruser">
							

						</tbody>
					</table>
				</div>
			</div>
		
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Data Jenis Peraturan</h6>
					
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="reload"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr>
								<th>Jenis Peraturan</th>
								<th>Jumlah</th>
								<th>Berlaku</th>
								<th>Tidak Berlaku</th>
							</tr>
						</thead>
						<tbody class="jenisPeraturan">
							

						</tbody>
					</table>
				</div>
			</div>
			
			
		</div>
		
	</div>
					


@endsection


@section('my_script')
<script>
$(document).ready(function() {
	
	
	get_dashboard();
});

function get_dashboard(){
	
	var light = $('body');
	$.ajax({
		type: 'GET',
		url: "{{ route('dashboard') }}",
		data: null,
		cache:false,
		beforeSend:function(){
			HoldOn(light);
		},
		complete:function(){
			HoldOff(light);
		},
		headers: {
			"X-CSRF-TOKEN": "{{ csrf_token() }}"
		}
	}).done(function(data){
		
		if(data.code==200){
			$('.berlaku').html(data.contents.berlaku);
			$('.tdkBerlaku').html(data.contents.tdkBerlaku);
			$('.totalPeraturan').html(data.contents.totalPeraturan);
			$('.totalVisit').html(data.contents.totalVisit);
			$('.todayVisit').html(data.contents.todayVisit);
			$('.latestVisitor').html(data.contents.latestVisitor);
			$('.jenisPeraturan').html(data.contents.jenisPeraturan);
			// $('.berlakuTidak').html(data.contents.berlakuTidak);
			$('.dataPeruser').html(data.contents.dataPeruser);
			
			$(".table tr").each(function (i) {

				// Title
				var $title = $(this).find('.letter-icon-title'),
					letter = $title.eq(0).text().charAt(0).toUpperCase();

				// Icon
				var $icon = $(this).find('.letter-icon');
					$icon.eq(0).text(letter);
			});
		}else{
			alert(data.contents);
		}
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});

}
</script>
@endsection