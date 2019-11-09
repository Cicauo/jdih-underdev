@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
						<div class="col-lg-4">

							<div class="panel bg-teal-400">
								<div class="panel-body">
									<div class="heading-elements">
										<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
									</div>

									<h3 class="no-margin">{{ $kelompok->jml_kantor }}</h3>
									Kantor
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>

						</div>
						<div class="col-lg-4">

							
							<div class="panel bg-pink-400">
								<div class="panel-body">
									<div class="heading-elements">
										<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
									</div>

									<h3 class="no-margin">{{ $kelompok->jml_bagian }}</h3>
									Bagian
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>

						</div>
						<div class="col-lg-4">

							
							<div class="panel bg-blue-400">
								<div class="panel-body">
									<div class="heading-elements">
										<!-- <span class="heading-text badge bg-teal-800">+53,6%</span> -->
									</div>

									<h3 class="no-margin">{{ $nomor }}</h3>
									Pegawai
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>

						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
