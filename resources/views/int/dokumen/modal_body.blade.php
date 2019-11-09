<div class="table-responsive">
	<table class="table table-bordered table-framed">
		<thead>
			<tr>
				<th>#</th>
				<th>Data</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Jenis Peraturan</th>
				<td>{{ $data->peraturan->nama_peraturan }}</td>
			</tr>
			<!--  
			<tr>
				<th>Katalog</th>
				<td> $data->katalog->nama_katalog </td>
			</tr>
			-->
			<tr>
				<th>Nomor Dokumen</th>
				<td>{{ $data->nomor_dokumen }}</td>
			</tr>
			<tr>
				<th>Tahun Dokumen</th>
				<td>{{ $data->tahun_dokumen }}</td>
			</tr>
			<tr>
				<th>File Dokumen</th>
				<td>
					<div class="media-left media-middle">
						<a href="{{ route('data.dokumen.download', [$data->id, $data->file_dokumen] ) }}" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
							<span class="icon-file-pdf"></span>
						</a>
					</div>
				</td>
			</tr>
			<tr>
				<th>File Lampiran</th>
				<td>
					<div class="media-left media-middle">
					@if($data->file_lampiran)
						@foreach($data->file_lampiran as $k=>$fl)
						<a href="{{ route('data.dokumen.download_lampiran', [$data->id, $fl] ) }}" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
							<span class="icon-file-pdf"></span>
							Lampiran {{ $k+1 }} 
						</a>&nbsp;&nbsp;
						@endforeach
					@endif
					</div>
				</td>
			</tr>
			<tr>
				<th>Berlaku</th>
				<td>{{ $data->berlaku ? 'Ya' : 'Tidak' }}</td>
			</tr>
			<tr>
				<th>Deskripsi</th>
				<td>{{ $data->deskripsi }}</td>
			</tr>
			<tr>
				<th>Abstrak</th>
				<td>{{ $data->abstrak }}</td>
			</tr>
			<tr>
				<th>Mencabut</th>
				<td>
					<ul>
						@foreach($data['mencabut'] as $prm)
							<li>{{ $prm['nama_peraturan'] }} Nomor {{ $prm['nomor_dokumen'] }} Tahun {{ $prm['tahun_dokumen'] }}</li>
						@endforeach()
					</ul>
				</td>
			</tr>
			<tr>
				<th>Dicabut</th>
				<td>
				@if($data['dicabut'])
					<ul>
						<li>{{ $data['dicabut'] }}</li>
					</ul>
				@endif
				</td>
			</tr>
			<tr>
				<th>Ditetapkan</th>
				<td>{{ $data->ditetapkan }}</td>
			</tr>
			<tr>
				<th>Disahkan</th>
				<td>{{ $data->disahkan }}</td>
			</tr>
			<tr>
				<th>Lembaran Negara</th>
				<td>{{ $data->lembaran_negara }}</td>
			</tr>
			<tr>
				<th>Berita Negara</th>
				<td>{{ $data->berita_negara }}</td>
			</tr>
		</tbody>
	</table>
</div>