@extends('layouts.admin')

@section('page-head')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
</div>

<!-- Row -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <a href="{{route('dashboard')}}" class="btn btn-warning">Kembali</a>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Tanggal Pesanan</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Tanggal Pesanan</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($transaction as $t)
                <tr>
                  <td>{{date('d-m-Y h:i A', strtotime($t->created_at))}}</td>
                  <td>Rp. {{number_format($t->amount,0,",",".")}}</td>
                  <td>
                    @if ($t->status == 'pending')
                    <span class="badge badge-dangers">Pending</span>
                    @elseif($t->status == 'settlement')
                    <span class="badge badge-primary">Settlement</span>
                    @elseif($t->status == 'process')
                    <span class="badge badge-warning">Process</span>
                    @else
                    <span class="badge badge-success">Complete</span>
                    @endif
                  </td>
                  <td><a href="{{route('admin-transactionDetail',['id'=> $t->id])}}" class="btn btn-sm btn-primary">Detail</a></td>
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