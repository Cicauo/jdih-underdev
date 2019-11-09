@extends('layouts.app')

@section('theme_js')
<script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/js/pages/login.js') }}"></script>
@endsection

@section('content')

<!-- Unlock user -->
<form method="POST" action="{{ route('auth.login') }}" aria-label="{{ __('Login') }}">
	
	<div class="panel login-form" style="margin: 0 auto 20px auto;width: 320px;background-color: #37474f;">
		<div class=" " style=" text-align: center; padding: 20px 0px; ">
			<img src="{{ asset('front/images/logo2-garing.png') }}" alt="" style=" width:80%;margin-left: -13px; ">
			<div class="caption-overflow">
				<span>
					<a href="{{ route('welcome') }}" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-xs"><i class="icon-earth"></i></a>
				</span>
			</div>
		</div>

		<div class="panel-body">
		
			@if (\Session::has('error'))
				<div class="alert alert-warning no-border">
					<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
					{{ \Session::get('error') }}
				</div>
			@endif
			
		<h6 style=" color: #fff; " class="content-group text-center text-semibold no-margin-top">{{ __('Login') }} <small class="display-block">Masuk ke Aplikasi JDIH</small></h6>
			@csrf
			
			<div class="form-group has-feedback">
				<input type="email" name="email" required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" >
				<div class="form-control-feedback">
				@if ($errors->has('email'))
					<i class="icon-user-lock text-muted"></i>
					{{ $errors->first('email') }}
				@endif
				</div>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" required class="psw-masuk form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" >
				<div class="form-control-feedback">
				@if ($errors->has('password'))
					<i class="icon-user-lock text-muted"></i>
					{{ $errors->first('password') }}
				@endif
				</div>
			</div>
			<div class="form-group has-feedback">
				<div style="margin-bottom:10px;">{{ captcha_img() }}</div>
				
				<input type="text" name="captcha" required class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="captcha" >
				
				<div class="form-control-feedback">
				@if ($errors->has('captcha'))
					<i class="icon-user-lock text-muted"></i>
					{{ $errors->first('captcha') }}
				@endif
				</div>
			</div>
		
		<div class="form-group login-options">
			<div class="row">
				<div class="col-sm-6">
					<label class="checkbox-inline" style=" color: #fff; ">
						<input type="checkbox" class="styled" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
						{{ __('Ingat Saya') }}
					</label>
				</div>

				<div class="col-sm-6 text-right">
					<a href="{{ route('password.request') }}">{{ __('Lupa Password?') }}</a>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-primary btn-block btn-masuk">{{ __('Masuk') }} <i class="icon-arrow-right14 position-right"></i></button>
		</div>
	</div>

</form>
<!-- /unlock user -->

@endsection

@section('my_script')
<script>$(document).ready(function() {$('.btn-masuk').click(()=>{let psw = btoa($('.psw-masuk').val());$('.psw-masuk').val( psw );$('form').submit();});} );</script>
@endsection
