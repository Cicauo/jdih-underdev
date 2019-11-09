<script type="text/javascript" src="{{ asset('limitless/js/plugins/loaders/blockui.min.js') }}"></script>
<script>
$(document).ready(()=>{
	
	menu_one_click();
	load_produk_hukum();
	load_cms();
	visitor();
	
	
});

var light = $('#search-result');


function menu_one_click()
{
	for(var i=0; i< $('.dropdown-toggle').length; i++){
		console.log(i);
		$('.dropdown-toggle')[i].click()
	}
}

function load_cms()
{
	$.ajax({
		type: 'GET',
		url: "{{ route('api.cms.about') }}",
		data: null,
		cache:false,
		beforeSend:function(){
			$('.cms_tentang_kami').html('');
		},
		complete:function(){
			
		},
		headers: {
			"X-CSRF-TOKEN": "{{ csrf_token() }}"
		}
	}).done(function(data){
		
		if(data.code=200){
			var contents = data.contents;
			
			$('.cms_tentang_kami').html(contents[0].about);
			$('.cms_alamat').html(contents[0].address);
			$('.slide1').html(contents[0].slider1);
			$('.slide2').html(contents[0].slider2);
			$('.slide3').html(contents[0].slider3);
			$('.cms_alamat').html(contents[0].address);
			$('.cms_alamat').html(contents[0].address);
			$('.counter').html('Pengunjung Hari ini: '+contents[2]+'<br/>Pengunjung Kemarin: '+contents[3]+'<br/>Total Pengunjung: '+contents[1]+'<br/>Total Download: '+contents[4]);
			
		}else{
			console.log('Error load_cms');
		}
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function visitor()
{
	$.ajax({
		type: 'POST',
		url: "{{ route('api.store_visitor') }}",
		data: null,
		cache:false,
		beforeSend:function(){
			
		},
		complete:function(){
			
		},
		headers: {
			"X-CSRF-TOKEN": "{{ csrf_token() }}"
		}
	}).done(function(data){
		
		if(data.code=200){
			console.log(data);
			
		}else{
			console.log('Error save visitor');
		}
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function load_produk_hukum()
{
	$.ajax({
		type: 'GET',
		url: "{{ route('api.daftar_produk_hukum') }}",
		data: null,
		cache:false,
		beforeSend:function(){
			$('.menu-produk-hukum').html('');
			$('.menu-produk-hukum-m').html('');
		},
		complete:function(){
			
		},
		headers: {
			"X-CSRF-TOKEN": "{{ csrf_token() }}"
		}
	}).done(function(data){
		
		if(data.code=200){
			var contents = data.contents;
			
			$.each(contents, (k,v)=>{
				$('.menu-produk-hukum').append( '<a onclick="modalAnotasi('+v.id+')" class="dropdown-item" href="#Menu2">'+v.nama_produk+'</a>' );
				$('.menu-produk-hukum-m').append( '<a onclick="modalAnotasi('+v.id+')" href="#Menu2">'+v.nama_produk+'</a>' );
			});
			
		}
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}
function modalAnotasi(id)
{
	$.ajax({
		type: 'GET',
		url: "{{ route('api.anotasi') }}",
		data: 'id='+id,
		cache:false,
		beforeSend:function(){
			HoldOn(light);
			$('#modal-anotasi .modal-header').html('');
			$('#modal-anotasi .modal-body').html('');
			$('#modal-anotasi .modal-footer .btn-donlot').html('');
		},
		complete:function(){
			HoldOff(light);
		},
		headers: {
			"X-CSRF-TOKEN": "{{ csrf_token() }}"
		}
	}).done(function(data){
		
		if(data.code=200){
			var d = data.contents;
			$('#modal-anotasi .modal-header').html( '<h1>'+d.nama_produk+'</h1>' );
			$('#modal-anotasi .modal-body').html( '<div class="col-md-12">'+d.desc_produk+'</div>' );
			$('#modal-anotasi').modal('show');
			$('#modal-anotasi .modal-footer .btn-donlot').append( d.download_link );
			
		}
		
		
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function search(url="{{ route('api.search') }}", x=false)
{
	var param = '&'+$('#fSearch').serialize();
	$.ajax({
		type: 'GET',
		url: url,
		data: param,
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
		
		if(data.code=200){
			var contents = data.contents[0];
			var links = data.contents[1];
			$('#search-result').html('');
			
			if(contents.data < 1){
				$('#search-result').append( 'Data tidak ditemukan.' );
			}else {	
				$('#countSearchRsl').html( contents.from+' sampai '+contents['to'] + ' hasil pencarian dari total '+contents.total+' data' );
				$.each(contents.data, (k,v)=>{
					$('#search-result').append( v.html );
				});
			}
			
			$('.pagi-doc').html(links);
			
		}
		
		
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function search2(url="{{ route('api.search') }}", x=false)
{
	var light = $('#search-result');
	var param = '&'+$('#fSearch2').serialize();
	$.ajax({
		type: 'GET',
		url: url,
		data: param,
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
		
		if(data.code=200){
			var contents = data.contents[0];
			var links = data.contents[1];
			$('#search-result').html('');
			
			if(contents.data < 1){
				$('#search-result').append( 'Data tidak ditemukan.' );
			}else {				
				$.each(contents.data, (k,v)=>{
					$('#search-result').append( v.html );
				});
			}
			
			$('.pagi-doc').html(links);
			
		}
		
		
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function load_artikel(url="{{ route('api.artikel') }}", x=false)
{
	var light = $('#artikel-result');
	$.ajax({
		type: 'GET',
		url: url,
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
		
		if(data.code=200){
			var contents = data.contents[0];
			var links = data.contents[1];
			$('#artikel-result').html('');
			$.each(contents.data, (k,v)=>{
				$('#artikel-result').append( v.html );
			});
			$('.tot-art').html(data.contents[0].total);
			$('.pagi-art').html(links);
			
		}
		
		
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}

function load_buku(url="{{ route('api.buku') }}", x=false)
{
	var light = $('#buku-result');
	$.ajax({
		type: 'GET',
		url: url,
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
		
		if(data.code=200){
			var contents = data.contents[0];
			var links = data.contents[1];
			$('#buku-result').html('');
			$.each(contents.data, (k,v)=>{
				$('#buku-result').append( v.html );
			});
			$('.tot-buku').html(data.contents[0].total);
			$('.pagi-buku').html(links);
			
		}
		
		
		
	}).fail(function(errors) {
		
		alert("Gagal Terhubung ke Server");
		
	});
}
</script>

@include('layouts.general_script');