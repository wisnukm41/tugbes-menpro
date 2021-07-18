@extends('layouts.admin')

@section('page-head')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar Pesan</h1>
</div>

<!-- Row -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <a href="{{route('dashboard')}}" class="btn btn-warning">Kembali</a>
         <form action="{{route('admin-deleteReadMessages')}}" method="post" onsubmit="return confirm('Menghapus Semua Pesan Terbaca?')">
          @csrf
          <button class="btn btn-danger" {{ \App\Models\Message::where(['new' =>0])->count() == 0 ? "disabled" : ""}}>Hapus Terbaca</button>
          </form>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Judul</th>
              <th>Pengirim</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Judul</th>
              <th>Pengirim</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($messages as $m)
            <tr>

              <td><span style="{{$m->new ? 'font-weight:bold;' : ''}}">{{$m->title}}</span></td>
              <td>{{$m->name}}</td>
              <td>{{date('d-m-Y', strtotime($m->created_at))}}</td>
              <td>
                <span class="d-flex flex-row">
                  <a href="{{route('admin-showMessages',['id' => $m->id])}}" class="btn btn-primary btn-sm mr-1"><i class="far fa-eye"></i></a>
                  <form action="{{route('admin-deleteMessages',['id'=>$m->id])}}" method="post">
                    @csrf
                    <button  class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                  </form>
                </span>
              </td>
            </tr>
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
      $('#dataTableHover').DataTable(); 
    });
  </script>
@endsection