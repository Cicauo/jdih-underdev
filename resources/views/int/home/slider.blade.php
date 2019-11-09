@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/wysihtml5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/toolbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/parsers.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/jgrowl.min.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Basic datatable -->
<form method="POST" action="{{ route('cms.slider.update') }}" >
	@csrf
	<input type="hidden" name="id" value="{{ @$data->id }}">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Slider</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
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
			
			<div class="form-group">
				<label>Slider 1:</label>
				<textarea rows="3" cols="5" class="wysihtml5 wysihtml5-min form-control" placeholder="Masukkan Isi Slider" name="slider1">{{ old('slider1') ?: @$data->slider1 }}</textarea>
				@if ($errors->has('slider1'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('slider1') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label>Slider 2:</label>
				<textarea rows="3" cols="5" class="wysihtml5 wysihtml5-min form-control" placeholder="Masukkan Isi Slider" name="slider2">{{ old('slider2') ?: @$data->slider2 }}</textarea>
				@if ($errors->has('slider2'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('slider2') }}</span>
				@endif
			</div>
			<div class="form-group">
				<label>Slider 3:</label>
				<textarea rows="3" cols="5" class="wysihtml5 wysihtml5-min form-control" placeholder="Masukkan Isi Slider" name="slider3">{{ old('slider3') ?: @$data->slider3 }}</textarea>
				@if ($errors->has('slider3'))
					<div class="form-control-feedback">
						<i class="icon-notification2"></i>
					</div>
					<span class="help-block">{{ $errors->first('slider3') }}</span>
				@endif
			</div>
			
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Perbaharui <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</div>

	</div>
	<!-- /basic datatable -->
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
});


</script>
@endsection