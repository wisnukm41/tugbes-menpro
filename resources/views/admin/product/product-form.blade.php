@extends('layouts.admin')

@section('page-head')
  <link href="{{ asset('assets/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" >
  <link rel="stylesheet" href="{{ asset('assets/medium-editor/dist/css/medium-editor.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/medium-editor/dist/css/themes/bootstrap.min.css')}}">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  @if ($new)
    <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
  @else
    <h1 class="h3 mb-0 text-gray-800">Ubah Produk {{$product->name}}</h1>
  @endif
</div>
<div class="row">
  <div class="card mb-4 col-12">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <a href="{{$new ? route('admin-product') : route('admin-showProduct',['id'=>$id])}}" class="btn btn-warning">Kembali</a>
    </div>
    <div class="card-body">
      <form action="{{ $new ? route('admin-storeProduct') : route('admin-updateProduct',['id' => $id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="productName">Nama Produk</label>
          <input type="text" class="form-control {{@$errors->has('name') ? 'is-invalid' : ""}}" id="productName" aria-describedby="emailHelp" placeholder="Masukan Nama Produk" name='name' value="{{!$new ? $product->name : ""}}{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputHarga">Harga</label>
          <input id="inputHarga" type="number" class="form-control {{@$errors->has('price') ? 'is-invalid' : ""}}" name='price' value="{{!$new ? $product->price : ""}}">
          @error('price')
            <div class="form-error">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="bumpHarga">Harga Iklan <small>Optional</small></label>
          <input id="bumpHarga" type="number" class="form-control {{@$errors->has('bumpprice') ? 'is-invalid' : ""}}" name='bumpprice' value="{{!$new ? $product->bumpprice : ""}}">
          @error('bumpprice')
            <div class="form-error">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputStock">Stok</label>
          <input id="inputStock" type="number" class="form-control {{@$errors->has('stock') ? 'is-invalid' : ""}}" name='stock' value="{{!$new ? $product->stock : ""}}">
          @error('stock')
            <div class="form-error">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="selectType">Tipe Produk</label>
          <select class="form-control" id="selectType" name='type'>
            <option {{@$product->type == 'Bahan Dasar' ? "selected" : ""}}>Bahan Dasar</option>
            <option {{@$product->type == 'Siap Konsumsi' ? "selected" : ""}}>Siap Konsumsi</option>
            <option {{@$product->type == 'Tambahan' ? "selected" : ""}}>Tambahan</option>
          </select>
        </div>
        <div class="form-group">
          <label>Label</label>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="cs1" name="tags1" value="new" {{!$new ? (str_contains($product->tags,'new') ? "checked" : '') : ""}}>
            <label class="custom-control-label" for="cs1">New</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="cs2" name="tags2" value="bs" {{!$new ? (str_contains($product->tags,'bs') ? "checked" : '') : ""}}>
            <label class="custom-control-label" for="cs2">Best Seller</label>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi Produk</label>
          <textarea name="description" id="editable" style="outline:none;border: 1px solid {{@$errors->has('description') ? '#f92f32' : "#d4cecd"}}; border-radius:6px; padding:10px; min-height:70px">{!! !$new ? $product->description : ""!!}{!! old('description') !!}</textarea>
          @error('description')
            <div class="form-error">{{$message}}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{!$new ? "Simpan" : "Selanjutnya"}}</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{ asset('assets/medium-editor/dist/js/medium-editor.js')}}"></script>
<script>
  var editor = new MediumEditor('#editable', {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'strikethrough', 'anchor', 'orderedlist', 'unorderedlist', 'removeFormat'],
                },
                buttonLabels: 'fontawesome',
                placeholder:{
                  text: "Tulis Deskripsi Disini"
                },
                anchor: {
                    targetCheckbox: true,
                }
            });
  $(document).ready(function () {
    $('#inputHarga').TouchSpin({
        min: 0,
        max: 100000000,
        decimal: 2,
        initval: 0,
        step:1000,
        verticalbuttons: true,
        mousewheel: true,
        prefix: 'Rp.',
      }); 

      $('#bumpHarga').TouchSpin({
        min: 0,
        max: 100000000,
        decimal: 2,
        step:1000,
        verticalbuttons: true,
        mousewheel: true,
        prefix: 'Rp.',
      }); 

      $('#inputStock').TouchSpin({
        min: 0,
        max: 1000,
        decimal: 2,
        initval: 0,
        step:1,
        verticalbuttons: true,
        mousewheel: true,
      }); 
  });
</script>
@endsection