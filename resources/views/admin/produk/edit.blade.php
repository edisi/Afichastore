@extends('layouts.template') 

@section('judul', 'Produk') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Produk</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <a href="{{url('admin/produk')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>&nbsp; Kembali</a>
				    </div>
			      	<h3 class="box-title">Edit Produk</h3>
			    </div>

			    <form role="form" action="{{ url('admin/produk/'.$produk->id) }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	              	<div class="row">
	              		<div class="col-md-12">
	              			@include('pesan/error')
	              		</div>
						<div class="col-md-8">
			                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
			                  <label for="nama">Nama</label>
			                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="@if(count($errors) > 0){{old('nama')}}@else{{$produk->nama}}@endif" required="">
			                  @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
			                </div>
			                <!-- <div class="form-group">
			                  <label for="link">Link</label>
			                  <input type="link" class="form-control" id="link" name="link" placeholder="Link Produk">
			                </div> -->
			                <div class="form-group">
			                  <label for="judul">Judul</label>
			                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Produk" value="@if(count($errors) > 0){{old('judul')}}@else{{$produk->judul}}@endif" required="">
			                </div>
			                <div class="form-group">
			                  	<label for="teks">Teks</label>
			                  	<textarea id="teks" name="teks" rows="10" cols="80">@if(count($errors) > 0){{old('teks')}}@else{{$produk->teks}}@endif</textarea>
			                </div>
			            </div>
						<div class="col-md-4">
							<div class="form-group{{ $errors->has('berat') ? ' has-error' : '' }}">
				                  <label for="berat">Berat (Gram)</label>
				                  <input type="text" class="form-control" id="berat" name="berat" placeholder="Berat Produk Satuan Gram" value="@if(count($errors) > 0){{old('berat')}}@else{{$produk->berat}}@endif" required="">
				                  @if ($errors->has('berat'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('berat') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
				                  <label for="harga">Harga</label>
				                  <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Produk" value="@if(count($errors) > 0){{old('harga')}}@else{{$produk->harga}}@endif" required="">
				                  @if ($errors->has('harga'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('harga') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group">
			                  <label>Kategori Produk</label>
			                  <select name="kategori" class="form-control" required>
			                  	<option value="">Pilih Kategori</option>
			                  	@foreach($kategori as $k)
			                    	<option value="{{$k->id}}" @if($produk->kategori_id == $k->id)selected @endif>{{$k->nama}}</option>
			                    @endforeach
			                  </select>
			                </div>
							<div class="form-group">
								<label>Upload Gambar</label>
								@if($produk->gambar)
									@if(file_exists("upload/produk/kecil/". $produk->gambar))
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px; position:relative;">
												<div class="hapus-gambar">
													<a data-original-title="Hapus" data-placement="left" class="btn btn-bricky btn-danger tooltips" href="{{ url('admin/produk/hapusgambar/'. $produk->id) }}" onclick="return hapusgambar()">
														<i class="fa fa-trash"></i>
													</a>
												</div>
												<img src="{{ url('/upload/produk/kecil/'. $produk->gambar) }}">
											</div>										
										</div>
									@else
										<div class='successHandler alert alert-danger display'>
											<i class='glyphicon glyphicon-remove'></i> Error. Gambar Kosong. Silahkan upload lagi.
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
											<div>
												<span class="btn btn-warning btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
													<input type="file" name="gambar">
												</span>
												<a href="#" class="btn fileupload-exists btn-warning" data-dismiss="fileupload">
													Hapus
												</a>
											</div>
										</div>	
									@endif
								@else
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-warning btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
											<input type="file" name="gambar">
										</span>
										<a href="#" class="btn fileupload-exists btn-warning" data-dismiss="fileupload">
											Hapus
										</a>
									</div>
								</div>
								@endif
							</div>
			            </div>
			        </div>
	                
	              </div>

	              <div class="box-footer">
	              	{{ csrf_field() }}
	              	<input type="hidden" name="_method" value="PUT">
	                <button type="submit" name="simpan" class="btn btn-primary pull-right">Simpan</button>
	              </div>
	            </form>
			   
			</div>
		</div>
	</div>
</section>
@endsection