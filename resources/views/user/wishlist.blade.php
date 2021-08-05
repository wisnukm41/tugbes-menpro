@extends('layouts.user')

@section('content')
<div class="wrap-breadcrumb">
  <ul>
    <li class="item-link"><a href="{{route('home')}}" class="link">Home</a></li>
    <li class="item-link"><span>Wishlist</span></li>
  </ul>
</div>
<div class=" main-content-area">
  <div class="wrap-iten-in-cart">
    <h3 class="box-title">Products Name</h3>
    @if ($products->count() > 0)
    <ul class="products-cart">
      @foreach ($products as $p)
      @if ($p->product->stock > 0)
      <li class="pr-cart-item">
        <div class="product-image">
          <figure><img src="{{ $p->product->images->first() ? asset('files/images/'.$p->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$p->product->name}}"></figure>
        </div>
        <div class="product-name">
          <a class="link-to-product" href="{{route('detail',['id' => $p->product->id])}}">{{$p->product->name}}</a>
        </div>
        <div class="price-field produtc-price"><p class="price">Rp. {{number_format($p->product->price,0,",",".")}}</p></div>
        <div class="delete">
          <form action="{{route('add-chart')}}" method="post">
            @csrf
            <input type="hidden" name="wh" value="true">
            <input type="hidden" name="product-quatity" value="1">
            <input type="hidden" name="id" value="{{$p->product_id}}">
          <button class="btn delete-btn"  title="Add to Cart">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
          </button>
          </form>
        </div>
        <div class="delete">
          <form action="{{route('destroy-wishlist-one',['id'=>$p->id])}}" method="post">
            @csrf
          <button class="btn delete-btn" onclick="return confirm('Are You Sure?')" title="Remove From Wishlist">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
          </form>
        </div>
      </li>	
      @else
      <li class="pr-cart-item">
        <div class="product-image">
          <figure><img src="{{ $p->product->images->first() ? asset('files/images/'.$p->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$p->product->name}}"></figure>
        </div>
        <div class="product-name">
          <span><a class="link-to-product" href="{{route('detail',['id' => $p->product->id])}}"><del>{{$p->product->name}}</del></a> <p class="not-available">Not Available</p></span>
        </div>
        <div class="price-field produtc-price"><p class="price"><del>Rp. {{number_format($p->product->price,0,",",".")}}</del></p></div>
        <div class="delete">
          <form action="{{route('add-chart')}}" method="post">
            @csrf
            <input type="hidden" name="product-quatity" value="1">
            <input type="hidden" name="id" value="{{$p->product_id}}">
          <button class="btn delete-btn"  title="Add to Cart" style="pointer-events:none">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
          </button>
          </form>
        </div>
        <div class="delete">
          <form action="{{route('destroy-wishlist-one',['id'=>$p->id])}}" method="post">
            @csrf
          <button class="btn delete-btn" onclick="return confirm('Are You Sure?')" title="Remove From Wishlist">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
          </form>
        </div>
      </li>	
      @endif
		
      @endforeach							
    </ul>
    @else
        <h3>No Products Yet, <a style="color:black " href="{{route('shop')}}">Start Shopping</i></a></h3>
    @endif
   
  </div>

  <div class="wrap-show-advance-info-box style-1 box-in-site">
    <h3 class="title-box">Our Products</h3>
    <div class="wrap-products">
      <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
        @foreach ($random as $l)
        <div class="product product-style-2 equal-elem ">
          <div class="product-thumnail">
              <a href="{{route('detail',['id'=>$l->id])}}" title="{{$l->name}}">
                  <figure><img src="{{ $l->images->first() ? asset('files/images/'.$l->images->first()->image) : asset('files/images/no-image.jpg')}}" width="1000" height="1000" alt="{{$l->name}}"></figure>
              </a>
              <div class="group-flash">
                  @if (str_contains($l->tags,'new'))
                      <span class="flash-item new-label">new</span> 
                  @endif
                  @if ($l->bumpprice) 
                      <span class="flash-item sale-label">sale</span>
                  @endif
                  @if (str_contains($l->tags,'bs'))
                      <span class="flash-item bestseller-label">Bestseller</span>
                  @endif
              </div>
              <div class="wrap-btn">
                  <a href="{{route('detail',['id'=>$l->id])}}" class="function-link">quick view</a>
              </div>
          </div>
          <div class="product-info">
              <a href="{{route('detail',['id'=>$l->id])}}" class="product-name"><span>{{$l->name}}</span></a>
              <div class="product-rating">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
              </div>
              @if ($l->bumpprice) 
              <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($l->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp. {{number_format($l->bumpprice,0,",",".")}}</p></del></div>   
              @else
              <div class="wrap-price"><span class="product-price">Rp. {{number_format($l->price,0,",",".")}}</span></div>
              @endif
          </div>
        </div>
        @endforeach
      </div>
    </div><!--End wrap-products-->
  </div>

</div><!--end main content area-->
@endsection