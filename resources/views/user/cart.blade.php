@extends('layouts.user')

@section('content')
<div class="wrap-breadcrumb">
  <ul>
    <li class="item-link"><a href="{{route('home')}}" class="link">Home</a></li>
    <li class="item-link"><span>Cart</span></li>
  </ul>
</div>
<div class="main-content-area">
  <div class="wrap-iten-in-cart">
    <h3 class="box-title">Products Name</h3>
    @if($products->count() > 0)
    <ul class="products-cart">
      <form action="{{route('store-order')}}" method="post" id="store">
        @csrf
      </form>
      @foreach ($products as $p)
      @if ($p->product->stock > 0)
      <?php $temp_total = $p->product->price*$p->qty;
       $subtotal += $temp_total ?>
      <li class="pr-cart-item">
        <input type="hidden" name="product_id[]" value="{{$p->product->id}}" form="store">
        <input type="hidden" class="h-product-price" value="{{$p->product->price}}" name="product_price[]" form="store">
        <input type="hidden" class="h-product-subtotal" name="product_subtotal[]" value="{{$p->product->price * $p->qty}}" form="store">
        <input type="hidden" name="product_name[]" value="{{$p->product->name}}" form="store">
        <div class="product-image">
          <figure><img src="{{ $p->product->images->first() ? asset('files/images/'.$p->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$p->product->name}}"></figure>
        </div>
        <div class="product-name">
          <a class="link-to-product" href="{{route('detail',['id' => $p->product->id])}}">{{$p->product->name}}</a>
        </div>
        <div class="price-field produtc-price"><p class="price">Rp. {{number_format($p->product->price,0,",",".")}}</p></div>
        <div class="quantity">
          <div class="quantity-input">
            <input type="text" name="product_qty[]" class="inp-qty" value="{{$p->qty}}" data-max="{{$p->product->stock}}" pattern="[0-9]*" readonly form="store">									
            <a class="btn btn-increase b-m" href="#"></a>
            <a class="btn btn-reduce b-m" href="#"></a>
          </div>
        </div>
        
        <div class="price-field sub-total"><p class="price sub-price">Rp. {{number_format($temp_total,0,",",".")}}</p></div>
        <div class="delete">
          <form action="{{route('destroy-cart-one',['id'=>$p->id])}}" method="post">
            @csrf
          <button class="btn delete-btn" onclick="return confirm('Are You Sure?')">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
          </form>
        </div>
      </li>	
      @endif
      @endforeach	
      @if ($subtotal < 200000)
        <?php $total += $subtotal + 30000 ?>
        <input type="hidden" id="hidden_shp" name="shipment" form="store" value="30000">
      @else 
        <?php $total += $subtotal ?>
        <input type="hidden" id="hidden_shp" name="shipment" form="store" value="0">
      @endif
      <input type="hidden" name="total" id="hidden_total" value="{{$total}}" form='store'>	
      @foreach ($products as $p)
      @if ($p->product->stock <= 0)
      <li class="pr-cart-item">
        <div class="product-image">
          <figure><img src="{{ $p->product->images->first() ? asset('files/images/'.$p->product->images->first()->image) : asset('files/images/no-image.jpg')}}" alt="{{$p->product->name}}"></figure>
        </div>
        <div class="product-name">
          <span><a class="link-to-product" href="{{route('detail',['id' => $p->product->id])}}"><del>{{$p->product->name}}</del></a><p class="not-available">Not Available</p></span>
        </div>
        <div class="price-field produtc-price"><p class="price"><del> Rp. {{number_format($p->product->price,0,",",".")}}</del></p></div>
        <div class="delete">
          <form action="{{route('destroy-cart-one',['id'=>$p->id])}}" method="post">
            @csrf
          <button class="btn delete-btn" onclick="return confirm('Are You Sure?')">
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
  @if($products->count() > 0 && $subtotal > 0)
  <div class="summary">
    <div class="order-summary">
      <h4 class="title-box">Order Summary</h4>
      <p class="summary-info"><span class="title">Subtotal</span><b class="index">Rp. <span id="subtotal">{{number_format($subtotal,0,",",".")}}</span></b></p>
      <p class="summary-info"><span class="title">Shipping</span><b class="index"><span id="shipping">Rp. 30.000</span></b></p>
      <p class="summary-info total-info "><span class="title">Total</span><b class="index">Rp. <span id="total">{{number_format($total,0,",",".")}}</span></b></p>
    </div>
    <div class="checkout-info">
      @error('contact')
      <div style="color: red">{{$message}}</div>
      @enderror
      <input type="text" placeholder="contact" required name="contact" style="min-width: 100%; margin-bottom:4px; border:1px solid black" value="{{ $user->contact ? $user->contact : "" }}" form="store">
      @error('address')
      <div style="color: red">{{$message}}</div>
      @enderror
      <textarea name="address" id="" rows="5" required placeholder="address" style="resize: none; min-width: 100%; border:1px solid black" form="store">{{ $user->address ? $user->address : "" }}</textarea>
      <a class="btn btn-checkout">Check out</a>
      <a class="link-to-shop" href="{{route('shop')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
    </div>
    <div class="update-clear">
      <form action="{{route('destroy-cart')}}" method="post">
        @csrf
        <button class="btn" onclick="return confirm('Are You Sure?')">Clear Shopping Cart</button>
      </form>
      <a class="btn btn-update" href="{{route('cart')}}">Update Shopping Cart</a>
    </div>
  </div>
  @endif
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

@section('page-script')
    <script>
      $(document).ready(function() {

        $(".main-content-area").on('click','.b-m', dataChange);
        $(".main-content-area").on('click','.btn-checkout', submitForm);

        function dataChange() {
          var ship;
          var item = $(this).parents('.pr-cart-item');
          var price = item.find('.h-product-price').val();
          var qty = item.find('.inp-qty').val();
          var nf = Intl.NumberFormat('de-DE');
          var subtotal = qty*price;
          

          var hsub = item.find('.h-product-subtotal');
          hsub.val(subtotal);

          item.find('.sub-price').html(`Rp. ${nf.format(subtotal)}`);

          var total = 0;
          $(".h-product-subtotal").each(function() {
            total += (this.value * 1);
          });

          if(total > 200000){
            $("#shipping").html('Free');
            ship = 0;
          } else {
            $("#shipping").html('Rp. 30.000');
            ship = 30000;
          }
          $('#subtotal').html(nf.format(total));
          total = total + ship;

          $('#hidden_total').val(total);
          $('#hidden_shp').val(ship);
          $('#total').html(nf.format(total));
        }

        function submitForm(e) {
          console.log('hi')
          e.preventDefault();
          $('form#store').submit();
        }
      })


    </script>
@endsection