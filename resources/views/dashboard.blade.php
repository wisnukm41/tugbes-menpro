@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row mb3">
        <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{number_format($earnings,0,",",".")}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span>Bulan ini</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Penjualan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sales}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span>Tahun Ini</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-cart fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New User Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$new_user}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span>Tahun Ini</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Penjualan Baru</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$order}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-shopping-bag fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Penjualan</h6>
            <a class="m-0 float-right btn btn-danger btn-sm" href="{{route('admin-transaction')}}">View More <i
                class="fas fa-chevron-right"></i></a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaction as $t)
                <tr>
                  <td>{{$t->order_id}}</td>
                  <td>{{$t->user->name}}</td>
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
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
@endsection
