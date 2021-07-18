@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lihat Produk {{$product->name}}</h1>
    </div>
    <div class="row">
        <div class="card mb-4 col-12">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{route('admin-product')}}" class="btn btn-warning">Kembali</a>
                <span class="d-flex flex-row">
                    <a href="{{route('admin-editImage',['id'=>$id])}}" class="btn btn-primary mr-1" title="Ubah Gambar"><i class="far fa-image"></i></a>
                    <a href="{{route('admin-editProduct',['id'=>$id])}}" class="btn btn-secondary mr-1" title="Ubah Produk"><i class="fas fa-pen-nib"></i></a>
                    <form action="{{route('admin-deleteProduct',['id'=>$id])}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Hapus Produk"><i class="far fa-trash-alt"></i></button>
                    </form>
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12"><h5>Daftar Gambar</h5></div>
                    @if ($images->isEmpty())
                            <i class="ml-3">Tidak ada gambar</i>
                    @else
                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="image_container justify-content-center position-relative col-12 col-sm-6 col-md-4 col-lg-3">
                                        <img src="{{asset('/files/images/'.$image->image)}}" alt="Image">
                                    </div>
                                @endforeach
                            </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Nama Produk</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$product->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Harga Produk</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$product->price}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Harga Iklan</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$product->bumpprice ? $product->bumpprice : '-'}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Stok Produk</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$product->stock}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Tipe Produk</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$product->type}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Label Produk</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{str_contains($product->tags,'new') ? 'New ':'' }}{{str_contains($product->tags,'bs') ? 'Best-Seller ':'' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>Deskripsi Produk</b>
                    </div>
                    <div class="col-12">
                        {!!$product->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection