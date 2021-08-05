@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi {{$order->order_id}}</h1>
    </div>
    <div class="row">
        <div class="card mb-4 col-12">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{route('admin-product')}}" class="btn btn-warning">Kembali</a>
                <span class="d-flex flex-row">
                  @if ($order->status == 'settlement')
                  <form action="{{route('admin-updateStatus',['type'=>'process'])}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <button class="btn btn-primary" title="Proses Pesanan">Proses</button>
                  </form>
                  @elseif ($order->status == 'process')
                  <form action="{{route('admin-updateStatus', ['type'=>'complete'])}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <button class="btn btn-success" title="Selesai Pesanan">Selesai</button>
                  </form>
                  @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Order ID</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$order->order_id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Nama</b>
                    </div>
                    <div class="col-12 col-md-8">
                        {{$order->user->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Kontak</b>
                    </div>
                    <div class="col-12 col-md-8">
                      {{$order->contact}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Alamat</b>
                    </div>
                    <div class="col-12 col-md-8">
                      {{$order->address}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <b>Status</b>
                    </div>
                    <div class="col-12 col-md-8">
                      @if ($order->status == 'pending')
                      <span class="badge badge-dangers">Pending</span>
                      @elseif($order->status == 'settlement')
                      <span class="badge badge-primary">Settlement</span>
                      @elseif($order->status == 'process')
                      <span class="badge badge-warning">Process</span>
                      @else
                      <span class="badge badge-success">Complete</span>
                      @endif
                    </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="card mt-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
                      </div>
                      <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <tr>
                              <th>Gambar</th>
                              <th>Nama Produk</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->list as $o)
                            <tr>
                              <td>
                                <div class="product-image">
                                  <img src="{{ !empty($o->product->images->first()->image) ? asset('files/images/'.$o->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$o->product->name}}" style="max-width:120px; max-height:120px; object-fit: cover">
                                </div>
                              </td>
                              <td>{{$o->product->name}}</td>
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
                                <b>Gratis</b>
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
                      <div class="card-footer"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection