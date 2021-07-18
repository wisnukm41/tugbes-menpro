@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lihat Pesan | {{$message->title}}</h1>
    </div>
    <div class="row">
        <div class="card mb-4 col-12">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{route('admin-messages')}}" class="btn btn-warning">Kembali</a>
                <span class="d-flex flex-row">
                    <form action="{{route('admin-deleteMessages',['id'=>$id])}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Hapus Produk"><i class="far fa-trash-alt"></i></button>
                    </form>
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Pengirim</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$message->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Email</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$message->email}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Kontak</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$message->contact ? $message->contact : "Tidak ada Kontak"}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Tanggal Pesan</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{date('d-m-Y', strtotime($message->created_at))}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Judul Pesan</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$message->title}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>Deskripsi Pesan</b>
                    </div>
                    <div class="col-12">
                        {{$message->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection