@extends('layouts.user')

@section('content')
<div class="wrap-breadcrumb">
  <ul>
    <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
    <li class="item-link"><span>Shop</span></li>
  </ul>
</div>
<div class="row">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget mercado-widget categories-widget">
      <h2 class="widget-title">All Categories</h2>
      <div class="widget-content">
        <ul class="list-category">
          <li class="category-item">
            <a href="{{route('shop-type', ['type' => 'raw' ])}}" class="cate-link">Raw Ingredient</a>
          </li>
          <li class="category-item">
            <a href="{{route('shop-type', ['type' => 'ready'])}}" class="cate-link">Ready to Consume</a>
          </li>
          <li class="category-item">
            <a href="{{route('shop-type', ['type' => 'extra'])}}" class="cate-link">Extra</a>
          </li>
        </ul>
      </div>
    </div><!-- Categories widget-->

    <div class="widget mercado-widget filter-widget price-filter">
      <h2 class="widget-title">Price</h2>
      <div class="widget-content">
        <div id="slider-range"></div>
        <p>
          <label for="amount">Price:</label>
          <input type="text" id="amount" readonly style="min-width: 130px">
          <button class="filter-submit">Filter</button>
        </p>
      </div>
    </div><!-- Price-->

    <div class="widget mercado-widget widget-product">
      <h2 class="widget-title">Latest Products</h2>
      <div class="widget-content">
        <ul class="products">
          @foreach ($latest as $l)
          <li class="product-item">
            <div class="product product-widget-style">
              <div class="thumbnnail">
                <a href="{{route('detail',['id'=>$l->id])}}" title="{{ $l->name }}">
                  <figure><img src="{{ $l->images->first() ? asset('files/images/'.$l->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$l->name}}"></figure>
                </a>
              </div>
              <div class="product-info">
                <a href="{{route('detail',['id'=>$l->id])}}" class="product-name"><span>{{ \Illuminate\Support\Str::limit($l->name, 70, '...') }}</span></a>
                @if ($l->bumpprice) 
                <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($l->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp. {{number_format($l->bumpprice,0,",",".")}}</p></del></div>   
                @else
                <div class="wrap-price"><span class="product-price">Rp. {{number_format($l->price,0,",",".")}}</span></div>
                @endif
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div><!-- brand widget-->

  </div><!--end sitebar-->
  <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
    <div class="banner-shop">
      <h2>{{@$type ? $type : "All Product"}}</h2>
    </div>
    <div class="row">
      
      <ul class="product-list grid-products equal-container">
        @foreach ($products as $p)
        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
          <div class="product product-style-3 equal-elem ">
            <div class="product-thumnail">
              <a href="{{route('detail',['id'=> $p->id])}}" title="{{$p->name}}">
                <figure><img src="{{ $p->images->first() ? asset('files/images/'.$p->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$p->name}}"></figure>
              </a>
            </div>
            <div class="product-info" style="min-height: 95px">
              <a href="{{route('detail',['id'=> $p->id])}}" class="product-name"><span>{{ \Illuminate\Support\Str::limit($p->name, 100, '...') }}</span></a>
              @if ($p->bumpprice) 
              <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($p->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp. {{number_format($p->bumpprice,0,",",".")}}</p></del></div>   
              @else
              <div class="wrap-price"><span class="product-price">Rp. {{number_format($p->price,0,",",".")}}</span></div>
              @endif
            </div>
            <a href="{{route('detail',['id'=> $p->id])}}" class="btn add-to-cart">Detail</a>
          </div>
        </li>
        @endforeach
      </ul>

    </div>

    <div class="wrap-pagination-info">
      {{ $products->links('vendor.pagination.default') }}
    </div>
  </div><!--end main products area-->



</div><!--end row-->
@endsection