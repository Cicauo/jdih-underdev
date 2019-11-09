@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/loaders/progressbar.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Data Dokumen</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<a href="{{ route('data.dokumen.add') }}">
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

		<table class="table datatable-ajaxku">
			<thead>
				<tr>
					<th>Nomor Dokumen</th>
					<th>Tahun Dokumen</th>
					<th>Jenis Peraturan</th>
					<!-- <th>Katalog</th> -->
					<th>Create At</th>
					<th>Updated At</th>
					<th>Updated By</th>
					<th>Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
	<!-- /basic datatable -->

@include('int.dokumen.modal')

@endsection

@section('my_script')
<script>
$(document).ready(function() {
	$.extend( $.fn.dataTable.defaults, {
        autoWidth: true,
        columnDefs: [{ 
            orderable: false,
            // width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span> _INPUT_',
            lengthMenu: '<span>Limit:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
	
	
    $('.datatable-ajaxku').DataTable( {
        processing: true,
        serverSide: true,
        ajax: '{{ route("data.dokumen.json") }}',
		"order": [[3,"desc"],[1, "desc" ],[0, "desc"]],
        columns: [
            { data: 'nomor_dokumen', 	name: 'nomor_dokumen' },
            { data: 'tahun_dokumen', 	name: 'tahun_dokumen' },
            { data: 'id_peraturan', 	name: 'id_peraturan' },
            //{ data: 'id_katalog', 		name: 'id_katalog' },
            { data: 'created_at', 		name: 'created_at' },
            { data: 'updated_at', 		name: 'updated_at' },
            { data: 'updated_by', 		name: 'updated_by' },
            { data: 'action', 			name: 'action' },
        ]
    } );
	
	
	
} );

function delete_confirm(url){
	swal({
		title: "Apakah anda akan menghapus data ini?",
		text: "Data yang terhapus tidak dapat dikembalikan lagi!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batalkan",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			swal({
				title: "Terhapus!",
				text: "Data telah terhapus di database.",
				confirmButtonColor: "#66BB6A",
				type: "success"
			});
			
			setTimeout(function(){
				window.location.href = url;
			}, 1000);
		}
		else {
			swal({
				title: "Dibatalkan",
				text: "Data batal dihapus",
				confirmButtonColor: "#2196F3",
				type: "error"
			});
		}
	});
}

function show_detail(id){
	
	var light = $('#modal_large');
	$.ajax({
		type: 'GET',
		url: "{{ URL::to('data/dokumen/detail') }}/"+id,
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
		
		$('#modal_large').modal('show');
		$('.modal-body').html(data);
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});

}
</script>
@endsection