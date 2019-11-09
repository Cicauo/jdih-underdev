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
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
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

	<form class="form-validation" method="POST" action="{{ route('data.dokumen.update') }}"  enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="id" value="{{ $data->id }}">
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
						<select name="id_peraturan" data-placeholder="Pilih Peraturan" class="select " required>
							<option></option>
							@foreach($peraturan as $peraturan)
							<option value="{{ $peraturan->id }}"
								@if( old('id_peraturan') == $peraturan->id || $data->id_peraturan == $peraturan->id)  selected="selected" @endif
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
						<input required type="text" name="nomor_dokumen" value="{{ old('nomor_dokumen') ?? $data->nomor_dokumen }}" class="form-control " placeholder="Nomor Dokumen">
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
						<input required type="text" name="tahun_dokumen" value="{{ old('tahun_dokumen') ?? $data->tahun_dokumen }}" class="form-control " placeholder="Tahun Dokumen">
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
								@if( old('id_katalog') == $katalog->id || $data->id_katalog == $katalog->id )  selected="selected" @endif  
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
					
					<div class="form-group file_exist @if($errors->has('file_dokumen')) has-error has-feedback @endif">
						<input type="hidden" name="file_exist" value="true">
						<label>File Dokumen: <span class="text-danger"></span></label>
						<div class="media-left media-middle">
							<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
								<span class="icon-file-pdf"></span>
							</a>
						</div>
						{{ $data->file_dokumen }}
						<a class="btn-link text-danger delete_file_exist">Hapus</a>
						
						@if ($errors->has('file_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('file_dokumen') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
					</div>
					
					<div style="display:none;" class="file_not_exist form-group @if($errors->has('file_dokumen')) has-error has-feedback @endif">
						<label>File Dokumen: <span class="text-danger">*</span></label>
						<input name="file_dokumen" type="file" class="file-styled">
						
						@if ($errors->has('file_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('file_dokumen') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
						<a class="btn-link text-info undo_delete_file_exist">Undo <i class="icon-file-pdf"></i></a>
					</div>

					<div  style="display:@if(!$data->file_lampiran) none @endif;" class="form-group lampiran_exist @if($errors->has('lampiran_dokumen')) has-error has-feedback @endif">
						<input type="hidden" name="lampiran_exist" value="true">
						<label>File Lampiran: <span class="text-danger"></span></label>
						<div class="media-left media-middle">
							<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
								<span class="icon-file-pdf"></span>
							</a>
						</div>
						@if($data->file_lampiran)
							@foreach( $data->file_lampiran as $ld )
								{{ $ld }}<br/>
							@endforeach
						@endif
						<a class="btn-link text-danger delete_lampiran_exist">Hapus semua lampiran</a>
						
						@if ($errors->has('lampiran_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('lampiran_dokumen') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
					</div>
					
					<div style="display:@if($data->file_lampiran) none @endif;" class="lampiran_not_exist form-group @if($errors->has('lampiran_dokumen')) has-error has-feedback @endif">
						<label>File Lampiran: <span class="text-danger">*</span></label>
						<input name="lampiran_dokumen[]" type="file" class="file-styled" multiple>
						
						@if ($errors->has('lampiran_dokumen'))
							<div class="form-control-feedback">
								<i class="icon-notification2"></i>
							</div>
							<span class="help-block">{{ $errors->first('lampiran_dokumen') }}</span>
						@else
							<span class="help-block">Format: pdf. Ukuran max file 50Mb</span>
						@endif
						<a style="display:@if(!$data->file_lampiran) none @endif;" class="btn-link text-info undo_delete_lampiran_exist">Undo <i class="icon-file-pdf"></i></a>
					</div>
					
					<div class="form-group">
						<label>
							<input name="berlaku" id="berlaku" type="checkbox" @if($data->berlaku) checked="checked" @endif data-on-color="success" data-off-color="default" data-on-text="Iya" data-off-text="Tidak" class="switch">
							Berlaku
						</label>
					</div>

					<div class="form-group">
						<label>Tentang:</label>
						<textarea name="desc_dokumen" rows="4" cols="4" placeholder="Deskripsi"
							class="form-control">{{ old('desc_dokumen') ?? $data->desc_dokumen }}</textarea>
					</div>		


				</div>

				<div class="col-md-6">

					
					<div class="form-group">
						<label>Abstrak:</label>
						<textarea name="abstrak" rows="12" cols="4" placeholder="Abstrak dokumen" 
							class="form-control">{{ old('abstrak') ?? $data->abstrak }}</textarea>
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
					<!--  
					<div class="form-group">
						<label>Mencabut</label>
						<select class="select-search" name="mencabut">
							<option></option>
							@foreach($dokumen as $dok)
								<option value="{{ $dok->id }}" @if($dok->id == $data->mencabut) selected="selected" @endif>
									{{ $dok->peraturan->nama_peraturan }} Nomor {{ $dok->nomor_dokumen }} Tahun {{ $dok->tahun_dokumen }}
								</option>
							@endforeach
						</select>
					</div>
					-->
					<?php 
					$sikdm = [];
					foreach($data->mencabut as $dm){
						array_push($sikdm,$dm['idp']);
					}
					?>
					<div class="form-group">
						<label>Mencabut</label>
						<div class="multi-select-full">
							<select class="multiselect-onchange-notice" multiple="multiple" name="mencabut[]">
								@foreach($dokumen as $dok)
									@if($data->id_dicabut != $dok->id)
										<option value="{{ $dok->id }}" @if(in_array($dok->id, $sikdm)) selected="selected" @endif>
											{{ $dok->peraturan->nama_peraturan }} Nomor {{ $dok->nomor_dokumen }} Tahun {{ $dok->tahun_dokumen }}
										</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label>Dicabut</label>
						<select class="select-search" name="dicabut">
							<option></option>
							@foreach($dokumen as $dok) 
								<option value="{{ $dok->id }}" @if($dok->id == $data->id_dicabut) selected="selected" @endif>
									{{ $dok->peraturan->nama_peraturan }} Nomor {{ $dok->nomor_dokumen }} Tahun {{ $dok->tahun_dokumen }}
								</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label>Ditetapkan:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar3"></i></span>
							<input type="text" name="ditetapkan" class="form-control" id="ditetapkan" value="{{ old('ditetapkan') ?? $data->ditetapkan }}">
						</div>	
					</div>

					<div class="form-group">
						<label>Diundangkan:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar3"></i></span>
							<input type="text" name="disahkan" class="form-control" id="disahkan" value="{{ old('disahkan') ?? $data->disahkan }}">
						</div>
					</div>

				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Lembaran Negara / Tambahan Lembaran Negara:</label>
						<textarea name="lembaran_negara" rows="4" cols="4" placeholder="Lembaran Negara" 
							class="form-control">{{ old('lembaran_negara') ?? $data->lembaran_negara }}</textarea>
					</div>
					<div class="form-group">
						<label>Berita Negara / Tamabahan Berita Negara:</label>
						<textarea name="berita_negara" rows="4" cols="4" placeholder="Berita Negara" 
							class="form-control">{{ old('berita_negara') ?? $data->berita_negara }}</textarea>
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
		            

@endsection

@section('my_script')
<script>

$(document).ready(function(){
	$(".switch").bootstrapSwitch();

	$("#disahkan, #ditetapkan").AnyTime_picker({
		format: "%d/%m/%Z"
	});

	$('.select-search').select2();
	
	$('.delete_file_exist').click(function(){
		$('.file_not_exist').css('display','block');
		$('.file_exist').css('display','none');
		return false;
	});
	
	$('.undo_delete_file_exist').click(function(){
		$('.file_not_exist').css('display','none');
		$('.file_exist').css('display','block');
		return false;
	});
	
	$('.delete_lampiran_exist').click(function(){
		$('.lampiran_not_exist').css('display','block');
		$('.lampiran_exist').css('display','none');
		return false;
	});
	
	$('.undo_delete_lampiran_exist').click(function(){
		$('.lampiran_not_exist').css('display','none');
		$('.lampiran_exist').css('display','block');
		return false;
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
});


</script>
@endsection
