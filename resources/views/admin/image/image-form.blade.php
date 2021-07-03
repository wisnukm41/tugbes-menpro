@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Gambar Produk {{$name}}</h1>
</div>
<div class="row">
	<div class="col-12">
		<div class="card shadow-sm mb-4">
      <div class="card-header d-flex justify-content-between">
        <h4>Tambah Gambar</h4>
        <form class="form" action="{{route('admin-storeImage', ['id'=> $id] )}}" method="post" id="form" enctype="multipart/form-data">
					@csrf
            <input type="file" name="image[]" id="image" multiple class="d-none" onchange="preview_image()"> 
            <span>
              <a class="btn btn-sm btn-warning" href="{{route('admin-showProduct',['id'=>$id])}}">Kembali</a>
              <button class="btn btn-sm btn-primary"  type="button" onclick="document.getElementById('image').click()">Pilih Gambar</button>
              <button class="btn btn-sm btn-success" id="btnSubmit" type="submit" disabled>Simpan</button>
            </span>
        </form>
      </div>
      <div class="card-body d-flex flex-wrap justify-content-start" id="container">
          <!-- image preview -->
      </div>
			<div class="card-footer">
				@error('image')
					<div class="form-error">{{$message}}</div>
				@enderror
				<small><i>Tekan Shift atau Ctrl untuk memilih gambar lebih dari 1, Per Gambar Max Size 5 MB, Maksimal gambar 6 pada penyimpanan</i></small>
			</div>
  	</div>
	</div>
	<div class="col-12">
		<div class="card shadow-sm mb-4">
			<div class="card-header py-3">
				<h4 class="m-0">Daftar Gambar</h4>
			</div>
			<div class="card-body d-flex flex-wrap justify-content-start">
				@if ($images->isEmpty())
						<i>Tidak ada gambar</i>
				@else
						<div class="row">
							@foreach ($images as $image)
								<div class="image_container d-flex justify-content-center position-relative">
									<img src="{{asset('/files/images/'.$image->image)}}" alt="Image">
									<form action="{{route('admin-deleteImage', ['id'=> $image->id] )}}" method="post" id="delete-{{$image->id}}">
										@csrf
										<a href="javascript: submitform({{$image->id}})" onclick="confirm('Apakah anda yakin?')"><span class="position-absolute"><i class="fas fa-trash-alt"></i></span></a>
									</form>
								</div>
							@endforeach
						</div>
				@endif
			</div>
		</div>
	</div>
  
</div>
@endsection

@section('page-script')
    <script>
	function preview_image() 
		{
			document.getElementById('container').innerHTML = "";
			var total_file = document.getElementById("image").files.length;
			for(var i=0;i<total_file;i++)
			{
				$('#container').append(`<div class="image_container d-flex justify-content-center position-relative"><img src="${URL.createObjectURL(event.target.files[i])}" alt="Image"></div>`);	
			}
			check_save();
		}
      var images = [];
      check_save();

      function check_save(){
		if({{$images->count()}} >= 6) return

        var element = document.getElementById('btnSubmit')
        var file = document.getElementById('image')
        if(file.files.length == 0){
         element.disabled = true
        } else {
         element.disabled = false
        }
      }

	  function submitform(id) {  document.getElementById(`delete-${id}`).submit(); } 
    </script>
@endsection