@extends('layouts.admin')

@section('page-head')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
</div>

<!-- Row -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <a href="{{route('dashboard')}}" class="btn btn-warning">Kembali</a>
         <a href="{{route('admin-addProduct')}}" class="btn btn-primary">Tambah</a>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Tipe</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nama</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Tipe</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($products as $p)
                <td>{{$p->name}}</td>
                <td>{{$p->price}}</td>
                <td>{{$p->stock}}</td>
                <td>{{$p->type}}</td>
                <td>
                  <span>
                    <a href="{{route('admin-showProduct',['id'=>$p->id])}}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </span>
                </td>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--Row-->
    
@endsection

@section('page-script')
  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
@endsection