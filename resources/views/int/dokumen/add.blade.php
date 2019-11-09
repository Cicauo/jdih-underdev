@extends('layouts.app')

@section('theme_js')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/wizards/form_wizard/form.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/wizards/form_wizard/form_wizard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/jgrowl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/ui/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/anytime.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/pickadate/picker.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/pickers/pickadate/legacy.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/switch.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/js/pages/wizard_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/form_inputs.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/notifications/pnotify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<div class="panel panel-white">
	<div class="panel-heading">
		<h6 class="panel-title">Form Data Dokumen</h6>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	
	@if (\Session::has('error'))
		<div class="alert alert-warning no-border">
			<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">Terjadi kesalahan!</span> {{ \Session::get('error') }}
		</div>
	@endif

	<form class="form-validation" method="POST" action="{{ route('data.dokumen.save') }}"  enctype="multipart/form-data">
		@csrf
		<fieldset class="step" id="step1">
				<h6 class="form-wizard-title text-semibold">
				<span class="form-wizard-count">1</span>
				Kategori Dokumen
				<small class="display-block">
					Silahkan pilih jenis peraturan, nomor dan tahun dokumen
				</small>
			</h6>

			<div class="row">
				
				<div class="col-md-7">
					<div class="form-group @if($errors->has('id_peraturan')) has-error has-feedback @endif">
						<label>Jenis Peraturan: <span class="text-danger">*</span></label>
						<select name="id_peraturan" required="required" data-placeholder="Pilih Peraturan" class="select " >
							<option></option>
							@foreach($peraturan as $peraturan)
							<option value="{{ $peraturan->id }}"
								@if( old('id_peraturan') == $peraturan->id )  selected="selected" @endif
							>{{ $peraturan->nama_peraturan }}</option>
							@endforeach
						</select>
						@if ($errors->has('id_peraturan'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('id_peraturan') }}</span>
						@endif
					</div>
				</div>

				<div class="col-md-7">
					<div class="form-group @if($errors->has('nomor_dokumen')) has-error has-feedback @endif">
						<label>Nomor: <span class="text-danger">*</span></label>
						<input type="text" required="required" name="nomor_dokumen" value="{{ old('nomor_dokumen') }}" class="form-control " placeholder="Nomor Dokumen">
						@if ($errors->has('nomor_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('nomor_dokumen') }}</span>
						@endif
					</div>
				</div>
				
				<div class="col-md-7">
					<div class="form-group @if($errors->has('tahun_dokumen')) has-error has-feedback @endif">
						<label>Tahun: <span class="text-danger">*</span></label>
						<input type="text" required="required" name="tahun_dokumen" value="{{ old('tahun_dokumen') }}" class="form-control " placeholder="Tahun Dokumen">
						@if ($errors->has('tahun_dokumen'))
							
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('tahun_dokumen') }}</span>
						@endif
					</div>
				</div>
			</div>
			{{--
			<div class="row">
				<div class="col-md-6">
					<div class="form-group @if($errors->has('id_katalog')) has-error has-feedback @endif">
						<label>Katalog: <span class="text-danger">*</span></label>
						<select name="id_katalog" data-placeholder="Pilih Katalog" class="select ">
							<option></option>
							@foreach($katalog as $katalog)
							<option value="{{ $katalog->id }}" 
								@if( old('id_katalog') == $katalog->id )  selected="selected" @endif  
							>
								{{ $katalog->nama_katalog }}
							</option>
							@endforeach
						</select>
						@if ($errors->has('id_katalog'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('id_katalog') }}</span>
						@endif
					</div>
				</div>

				
			</div>
			--}}
		</fieldset>

		<fieldset class="step" id="step2">
			<h6 class="form-wizard-title text-semibold">
				<span class="form-wizard-count">2</span>
				File Dokumen
				<small class="display-block">
				Silahkan pilih dokumen peraturan yang akan diupload lalu mengisi kolom lainnya.
				</small>
			</h6>

			<div class="row">
				<div class="col-md-6">								
					<input type="hidden" name="file_exist" value="false">
					<div class="form-group @if($errors->has('file_dokumen')) has-error has-feedback @endif">
						<label>File Dokumen: <span class="text-danger">*</span></label>
						<input name="file_dokumen" type="file" class="file-styled" aria-required="true">
						
						@if ($errors->has('file_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('file_dokumen') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
					</div>		
					
					<input type="hidden" name="pendukung_exist" value="false">
					<div class="form-group @if($errors->has('file_pendukung')) has-error has-feedback @endif">
						<label>File Lampira: </label>
						<input name="file_pendukung[]" type="file" class="file-styled" multiple>
						
						@if ($errors->has('file_pendukung'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('file_pendukung') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>
							<input name="berlaku" id="berlaku" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Iya" data-off-text="Tidak" class="switch" checked="checked">
							Berlaku
						</label>
					</div>

					<div class="form-group">
						<label>Tentang:</label>
						<textarea name="desc_dokumen" rows="4" cols="4" placeholder="Deskripsi" class="form-control">{{ old('desc_dokumen') }}</textarea>
					</div>		


				</div>

				<div class="col-md-6">

					
					<div class="form-group">
						<label>Abstrak:</label>
						<textarea name="abstrak" rows="12" cols="4" placeholder="Abstrak dokumen" 
							class="form-control">{{ old('abstrak') }}</textarea>
					</div>

				</div>
			</div>
		</fieldset>
		
		<fieldset class="step" id="step3">
			<h6 class="form-wizard-title text-semibold">
				<span class="form-wizard-count">3</span>
				Historis
				<small class="display-block">Previous work places</small>
			</h6>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Mencabut</label>
						<div class="multi-select-full">
							<select class="multiselect-onchange-notice" multiple="multiple" name="mencabut[]">
								@foreach($dokumen as $dok)
									<option value="{{ $dok->id }}">
										{{ $dok->peraturan->nama_peraturan }} Nomor {{ $dok->nomor_dokumen }} Tahun {{ $dok->tahun_dokumen }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Dicabut</label>
						<select class="select-search" name="dicabut">
							<option></option>
							@foreach($dokumen as $dok)
								<option value="{{ $dok->id }}">
									{{ $dok->peraturan->nama_peraturan }} Nomor {{ $dok->nomor_dokumen }} Tahun {{ $dok->tahun_dokumen }}
								</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label>Ditetapkan:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar3"></i></span>
							<input type="text" name="ditetapkan" class="form-control" id="ditetapkan" value="{{ old('ditetapkan') }}">
						</div>	
					</div>

					<div class="form-group">
						<label>Diundangkan:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar3"></i></span>
							<input type="text" name="disahkan" class="form-control" id="disahkan" value="{{ old('disahkan') }}">
						</div>
					</div>

				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Lembaran Negara / Tambahan Lembaran Negara:</label>
						<textarea name="lembaran_negara" rows="4" cols="4" placeholder="Lembaran Negara" 
							class="form-control">{{ old('lembaran_negara') }}</textarea>
						
					{{--	<span class="label  label-striped label-striped-right">Lembaran Negara / Tambahan Lembaran Negara</span> --}}
					</div>
					<div class="form-group">
						<label>Berita Negara / Tambahan Berita Negara:</label>
						<textarea name="berita_negara" rows="4" cols="4" placeholder="Berita Negara" 
							class="form-control">{{ old('berita_negara') }}</textarea>
					
					{{--	<span class="label  label-striped label-striped-right">Berita Negara / Tambahan Berita Negara</span>--}}
					</div>
				</div>
			</div>
		</fieldset>

		<div class="form-wizard-actions">
			<a href="{{ route('data.dokumen') }}" class="btn btn-link">Kembali ke Daftar</a>
			<input class="btn btn-default" id="basic-back" value="Back" type="reset">
			<input class="btn btn-primary" id="basic-next" value="Next" type="submit">
		</div>
	</form>
</div>

<div class="modal fade abstract" id="modal-confirm">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body row">
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary">Simpan</button>
			</div>

		</div>
	</div>
</div>

@endsection

@section('my_script')
<script>
$(document).ready(function(){
	$(".switch").bootstrapSwitch();

	$("#disahkan, #ditetapkan").AnyTime_picker({
		format: "%d/%m/%Z"
	});

	$('.select-search').select2();
	$('.multiselect').multiselect({
        onChange: function() {
            $.uniform.update();
        }
    });
	$('.multiselect-onchange-notice').multiselect({
        buttonClass: 'btn btn-info',
        onChange: function(element, checked){
            $.uniform.update();
            new PNotify({
                // text: '<code></code> <br/> '+element[0].label,
                text: element[0].label,
                addclass: 'bg-teal alert-styled-left'
            });
        }
    });
	
	// $('form').submit(()=>{
		// let f = $('form').serializeArray();
		// console.log( f )
		// var body = '<div class="row">';
		// var arr = ['_token','id_peraturan','pendukung_exist','file_exist'];
		// $.each(f, (k,v)=>{
			// if($.inArray("test", exld) !== -1){

			// }
			// body += '<div class="col-md-6">';
			// body += '<div class="form-group">';
			// body += '			<label>'+v.name+':</label>';
			// body += '			<span>'+v.value+'</span> ';
			// body += '		</div>';
			// body += '</div>';
		// });
		// body += '</div>';
		// $('#modal-confirm .modal-body').html(body);
		// $('#modal-confirm').modal('show');
		// return false;
	// })
});
</script>
@endsection
