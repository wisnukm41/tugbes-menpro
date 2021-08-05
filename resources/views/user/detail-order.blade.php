@extends('layouts.user')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
            <li class="item-link"><span>Order</span></li>
        </ul>
    </div>
    <div class="row">
      <div class="col-sm-3">Order ID</div>
      <div class="col-sm-9">{{$order->order_id}}</div>
      <div class="col-sm-3">Name</div>
      <div class="col-sm-9">{{$order->user->name}}</div>
      <div class="col-sm-3">Contact</div>
      <div class="col-sm-9">{{$order->contact}}</div>
      <div class="col-sm-3">Address</div>
      <div class="col-sm-9">{{$order->address}}</div>
      <div class="col-sm-3">BNI VA Number</div>
      <div class="col-sm-9">{{$order->va}}</div>
      <div class="col-sm-3">Status</div>
      <div class="col-sm-9">{{$order->status}}</div>
      <div class="col-sm-3">Date</div>
      <div class="col-sm-9">{{date('d-m-Y h:i A', strtotime($order->created_at))}}</div>

    </div>
    <div class="row" style="padding-bottom: 50px; margin-top:20px">
      <h5>Product Detail</h5>
      <div class="table-responsive p-3">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->list as $o)
            <tr>

              <td>
                <div class="product-image">
                  <img src="{{ !empty($o->product->images->first()->image) ? asset('files/images/'.$o->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$o->product->name}}" class="img-order">
                </div>
              </td>
              <td><a href="{{route('detail',['id'=>$o->product->id])}}" class="p-detail-name">{{$o->product->name}}</a></td>
              <td>Rp. {{number_format($o->price,0,",",".")}}</td>
              <td>{{$o->qty}}</td>
              <td>Rp. {{number_format($o->price*$o->qty,0,",",".")}}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="4">Shipping</td>
              <td>
                @if ($order->shipment)
                Rp. {{number_format($order->shipment,0,",",".")}}
                @else
                <b>Free</b>
                @endif
              </td>
            </tr>
            <tr>
              <td colspan="4"><b>Total</b></td>
              <td>Rp. {{number_format($order->amount,0,",",".")}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endsection
