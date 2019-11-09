@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_layouts.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_select2.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('my_script')
<script type="text/javascript">
function textCounter(field, cnt, maxlimit) {         
  var cntfield = document.getElementById(cnt)   
  if (field.value.length > maxlimit) // if too long...trim it!
    field.value = field.value.substring(0, maxlimit);
    // otherwise, update 'characters left' counter
  else
    cntfield.value = maxlimit - field.value.length;
}
</script>
@endsection

@section('content')

<!-- Basic datatable -->
<form method="POST" action="{{ route('sms.send') }}">
	@csrf
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Form Campaign SMS</h5>
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
			
			<div class="form-group">
				<label>Perihal:</label>
				<input type="text" class="form-control" name="perihal" required=""/>
			</div>			
			
			<div class="form-group">
				<label>Tujuan:</label>
				<select multiple="multiple" name="id_kelompok[]" id="" class="select-search">
					<option value="">-- Pilih --</option>
					@foreach($kelompok as $klp)
					<option value="{{ $klp->id }}"> {{ $klp->nama_kelompok }} - {{ $klp->deskripsi }} ({{ $klp->nomor->count() }} pegawai) </option>
					@endforeach
				</select>
				
			</div>
			
			<div class="form-group">
				<label>Isi SMS:</label>
				<textarea 
					required
					name="campaign_text"
					id="q17"
					onKeyDown="textCounter(this,'q17length',129);"
					onKeyUp="textCounter(this,'q17length',129)"
					rows="5" cols="5" maxlength="129" class="form-control" 
					placeholder="Isi SMS" name="campaign_text">{{ old('campaign_text') }}</textarea>
			</div>
			
			<div class="form-group">
				<input style="" readonly="readonly" type="text" id='q17length' name="q17length" size="3" maxlength="3" value="" /> characters left</i>
			</div>
			
			<div class="form-group">
			
				<label for="" id="kuota_info">Tersisa ... SMS</label>
			
			</div>
			
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Kirim <i class="icon-arrow-right14 position-right"></i></button>
			</div>
			
		</div>

	</div>
</form>

@endsection