
<div class="item-list " data-toggle="modal" data-target="#aticle{{$data['id']}}">
	<table class="table">
		<tr>
			<td scope="col" style="background:url('{{ asset('uploads/buku/'.$data['id'].'/'.$data['sampul_buku']) }}')" class="img-buku">
				
			</td>
			<td>
				<h3>{{ $data['judul_buku'] }}</h3>
				<small><i class="fas fa-calendar-alt"></i> {{ $data['created_at'] }}</small>
				<p>
					{{ Illuminate\Support\Str::limit(strip_tags($data['desc_buku']),50) }}
				</p>
			</td>
			<td scope="col" class="align-middle">
				<!-- <i class="fas fa-angle-right"></i> -->
			</td>
		</tr>
	</table>
</div>
<div class="modal fade fulltext" id="aticle{{$data['id']}}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Buku</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<h3>{{ $data['judul_buku'] }}</h3>
				<p> {{ $data['created_at'] }}</p>

				<div class="content content-img">
					<div class="img-buku" title="Gambar sampul buku" style="background:url('{{ asset('uploads/buku/'.$data['id'].'/'.$data['sampul_buku']) }}')"></div>
					<div class="img-buku" title="Gambar daftar isi buku" style="background:url('{{ asset('uploads/buku/'.$data['id'].'/'.$data['daftarisi_buku']) }}')"></div>
				</div>

				<div class="content clearfix">
				{!! $data['desc_buku'] !!}
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
