
<a href="{{ route('eks.artikel_detail',$data['id']) }}">
	<div class="item-list" /*data-toggle="modal" data-target="#aticle{{$data['id']}}"*/ >
		<table class="table">
			<tr>
				<td scope="col" style="width:175px;">
					<img src="{{ asset('uploads/artikel/'.$data['id'].'/'.$data['sampul_artikel']) }}" class="img-fluid" width="450px;">
				</td>
				<td>
					<h3>{{ $data['judul_artikel'] }}</h3>
					<small><i class="fas fa-calendar-alt"></i> {{ $data['created_at'] }}</small>
					<p>
						{{ Illuminate\Support\Str::limit(strip_tags($data['isi_artikel']),200) }}
					</p>
				</td>
				<td scope="col" class="align-middle">
					<i class="fas fa-angle-right"></i>
				</td>
			</tr>
		</table>
	</div>
</a>
<div class="modal fade fulltext" id="aticle{{$data['id']}}">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Artikel</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<h3>{{ $data['judul_artikel'] }}</h3>
				<p> {{ $data['created_at'] }}</p>

				<div class="content content-img">
					<img src="{{ asset('uploads/artikel/'.$data['id'].'/'.$data['sampul_artikel']) }}" class="img-fluid" width="400px;">
				</div>

				<div class="content">
				{!! $data['isi_artikel'] !!}
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
