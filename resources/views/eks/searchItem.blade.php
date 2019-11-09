<div class="row">
	<div class="col-md-12">
		<div class="panel" style=" background-color: #f8f9fa; ">
			<div class="panel-body">
				<div class="item-doct">
					<div class="title-info-doct">
						<div class="d-flex flex-row">
							@if(!$data['berlaku'])
							<div class="p-2 bg-info1"><i class="fas fa-times-circle"></i> Tidak Berlaku</div>
							@else
							<div class="p-2 bg-info2"><i class="fas fa-check"></i> Berlaku</div>	
							@endif
							
							<?php 
							$bn = 0;
							if($data['lembaran_negara'] != '' ){
								$bn++;
							}
							if($data['berita_negara'] != '' ){
								$bn++;
							}
							?>
						
							<div class="p-2 bg-info3">{{ $bn }} Berita Negara</div>
						</div>
					</div>

					<div class="title-item">
						<h3>{{ $data['peraturan']['nama_peraturan'] }} Nomor {{ $data['nomor_dokumen'] }} TAHUN {{ $data['tahun_dokumen'] }}</h3>
						<p>{{ $data['desc_dokumen'] }}</p>
					</div>

					<div class="content col-nopadding">
						{{ $data['tgl_create'] }}
					</div>

					<div class="col-btn btn-search-res">
						<div class="d-flex flex-row-reverse" style=" float: left; ">
							<a href="{{ route('api.download', [$data->id, $data->file_dokumen] ) }}"><div class="p-2 "><i class="fas fa-arrow-down"></i> Download</div></a>
							<div class="p-2 " data-toggle="modal" data-target="#fulltext{{$data['id']}}"><i class="fas fa-align-justify"></i> Full Text</div>
							<div class="p-2 " data-toggle="modal" data-target="#abstak{{$data['id']}}"><i class="fas fa-eye"></i> Abstrak</div>
							
						</div>
						<div style="clear:both;"></div>
					</div>

					<div class="modal fade abstract" id="abstak{{$data['id']}}">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">Abstrak</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body row">
									<div class="col-md-8">
										<h3>{{ $data['peraturan']['nama_peraturan'] }}</h3>
										<ul>
											<li>Nomor : {{ $data['nomor_dokumen'] }} Tahun {{ $data['tahun_dokumen'] }}</li>
											<li>TENTANG : {{ $data['desc_dokumen'] }}</li>
											<li>Abstrak: {{ $data['abstrak'] }}</li>
											{{-- <li>Katalog: {{ $data['katalog']['nama_katalog'] }}</li> --}}
										</ul>

										<h3>Historis</h3>
										<ul>
											<li>Mencabut : 
												<ul>
													@foreach($data['mencabut'] as $prm)
														<li>{{ $prm['nama_peraturan'] }} Nomor {{ $prm['nomor_dokumen'] }} Tahun {{ $prm['tahun_dokumen'] }}</li>
													@endforeach()
												</ul>
											</li>
											<li>Dicabut : 
												<ul>
												@if($data['dicabut'])
													<li>{{ $data['dicabut'] }}</li>
												@endif
												</ul>
											</li>
											<li>Ditetapkan : {{ $data['ditetapkan'] }}</li>
											<li>Diundangkan : {{ $data['disahkan'] }}</li>
											<li>Lembaran Negara / Tambahan Lembaran Negara: {{ $data['lembaran_negara'] }}</li>
											<li>Berita Negara / Tambahan Berita Negara: {{ $data['berita_negara'] }}</li>
										</ul>
									
									</div>
									
									<div class="col-md-4">
										<h3>File Lampiran</h3>
										@if($data->file_lampiran)
											@foreach($data->file_lampiran as $k=>$fl)
												<a href="{{ route('api.download_lampiran', [$data->id, $fl] ) }}" class="btn btn-link">
													Download Lampiran {{ $k+1 }} 
												</a>&nbsp;&nbsp;
											@endforeach
										@endif
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								</div>

							</div>
						</div>
					</div>

					<div class="modal fade fulltext" id="fulltext{{$data['id']}}">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">Membaca Online</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									
									<embed src="{{ $data['pdf_url'] }}" width="100%" height="1000px" />
									
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="">
	
	</div>
</div>