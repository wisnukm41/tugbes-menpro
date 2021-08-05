@extends('layouts.user')

@section('page-head')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
            <li class="item-link"><span>Order</span></li>
        </ul>
    </div>
    <div class="row" style="padding-bottom: 50px">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Order ID</th>
              <th>Amount</th>
              <th>BNI VA Number</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Order ID</th>
              <th>Amount</th>
              <th>BNI VA Number</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($transaction as $t)
            <tr>
              <td>{{$t->order_id}}</td>
              <td>Rp. {{number_format($t->amount,0,",",".")}}</td>
              <td>
                @if ($t->status == 'deny' || $t->status == 'cancel' || $t->status == 'expired')
                <del> {{$t->va}}</del>
                @else
                {{$t->va}}
                @endif
              </td>
              <td>{{date('d-m-Y h:i A', strtotime($t->created_at.'+1 days'))}}</td>
              <td>
                @if ($t->status == 'settlement' || $t->status == 'capture' || $t->status == 'complete')
                <span class="text-primary" >{{$t->status}}</span>
                @elseif($t->status == 'deny' || $t->status == 'cancel' || $t->status == 'expired')
                <span class="text-danger">{{$t->status}}</span>
                @else
                  {{$t->status}}
                @endif
              </td>
              <td>
                <a href="{{route('detail-order',['id'=>$t->order_id])}}" class="btn btn-primary">Detail</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
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