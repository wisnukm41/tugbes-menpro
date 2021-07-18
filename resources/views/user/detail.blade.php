@extends('layouts.user')

@section('content')
<div class="row">

  <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
    <div class="wrap-product-detail">
      <div class="detail-media">
        <div class="product-gallery" style="width: 430px">
          <ul class="slides">
            <li data-thumb="{{ asset('user-assets/images/products/digital_18.jpg')}}">
              <img src="{{ asset('user-assets/images/products/digital_18.jpg')}}" alt="product thumbnail" />
            </li>
            <li data-thumb="{{ asset('user-assets/images/products/digital_18.jpg')}}">
              <img src="{{ asset('user-assets/images/products/digital_18.jpg')}}" alt="product thumbnail" />
            </li>
            <li data-thumb="{{ asset('user-assets/images/products/digital_18.jpg')}}">
              <img src="{{ asset('user-assets/images/products/digital_18.jpg')}}" alt="product thumbnail" />
            </li>
            <li data-thumb="{{ asset('user-assets/images/products/digital_18.jpg')}}">
              <img src="{{ asset('user-assets/images/products/digital_18.jpg')}}" alt="product thumbnail" />
            </li>
          </ul>
        </div>
      </div>
      <div class="detail-info">
        <div class="product-rating">
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <a href="#" class="count-review">(05 review)</a>
        </div>
        <h2 class="product-name">{{$detail->name}}</h2>
        @if ($detail->bumpprice) 
        <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($detail->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp. {{number_format($detail->bumpprice,0,",",".")}}</p></del></div>   
        @else
        <div class="wrap-price"><span class="product-price">Rp. {{number_format($detail->price,0,",",".")}}</span></div>
        @endif
        <div class="stock-info in-stock">
            @if ($detail->stock > 0)
              <p class="availability">Availability: <b>In Stock</b></p>
            @else
              <p class="availability">Availability: <b style="color: grey">Sold</b></p>
            @endif
        </div>
        @auth
        @if ($detail->stock > 0)
        <div class="quantity">
          <span>Quantity:</span>
          <form action="{{route('add-chart')}}" method="post" id="qty-form">
            @csrf
          <div class="quantity-input">
            <input type="hidden" name="id" value="{{$detail->id}}">
            <input type="text" name="product-quatity" value="1" data-max="{{$detail->stock}}" pattern="[0-9]*" readonly>
            <a class="btn btn-reduce" href="#"></a>
            <a class="btn btn-increase" href="#"></a>
          </div>
          </form>
        </div>
        @endif
        <div class="wrap-butons">
          <a href="{{route('add-chart')}}" class="btn add-to-cart" {{$detail->stock <= 0 ? "style=pointer-events:none" : ""}} onclick="event.preventDefault();document.getElementById('qty-form').submit();">Add to Cart</a>
          <div class="wrap-btn">
              <span ><a href="#" class="btn btn-wishlist f-red" >Wishlist</a></span>
          </div>
        </div>
        @endauth
        @guest
        <div class="wrap-butons">
          <a class="btn add-to-cart" href="{{route('login')}}">Login to Order</a>
        </div>
        @endguest
      </div>
      <div class="advance-info">
        <div class="tab-control normal">
          <a href="#description" class="tab-control-item active">description</a>
          <a href="#review" class="tab-control-item">Reviews</a>
        </div>
        <div class="tab-contents">
          <div class="tab-content-item active" id="description">
            {!! $detail->description !!}
          </div>
          <div class="tab-content-item " id="review">
            
            <div class="wrap-review-form">
              
              <div id="comments">
                <h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
                <ol class="commentlist">
                  <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                    <div id="comment-20" class="comment_container"> 
                      <img alt="" src="assets/images/author-avata.jpg" height="80" width="80">
                      <div class="comment-text">
                        <div class="star-rating">
                          <span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
                        </div>
                        <p class="meta"> 
                          <strong class="woocommerce-review__author">admin</strong> 
                          <span class="woocommerce-review__dash">–</span>
                          <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
                        </p>
                        <div class="description">
                          <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        </div>
                      </div>
                    </div>
                  </li>
                </ol>
              </div><!-- #comments -->

              <div id="review_form_wrapper">
                <div id="review_form">
                  <div id="respond" class="comment-respond"> 

                    <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                      <p class="comment-notes">
                        <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                      </p>
                      <div class="comment-form-rating">
                        <span>Your rating</span>
                        <p class="stars">
                          
                          <label for="rated-1"></label>
                          <input type="radio" id="rated-1" name="rating" value="1">
                          <label for="rated-2"></label>
                          <input type="radio" id="rated-2" name="rating" value="2">
                          <label for="rated-3"></label>
                          <input type="radio" id="rated-3" name="rating" value="3">
                          <label for="rated-4"></label>
                          <input type="radio" id="rated-4" name="rating" value="4">
                          <label for="rated-5"></label>
                          <input type="radio" id="rated-5" name="rating" value="5" checked="checked">
                        </p>
                      </div>
                      <p class="comment-form-author">
                        <label for="author">Name <span class="required">*</span></label> 
                        <input id="author" name="author" type="text" value="">
                      </p>
                      <p class="comment-form-email">
                        <label for="email">Email <span class="required">*</span></label> 
                        <input id="email" name="email" type="email" value="" >
                      </p>
                      <p class="comment-form-comment">
                        <label for="comment">Your review <span class="required">*</span>
                        </label>
                        <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                      </p>
                      <p class="form-submit">
                        <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                      </p>
                    </form>

                  </div><!-- .comment-respond-->
                </div><!-- #review_form -->
              </div><!-- #review_form_wrapper -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--end main products area-->

  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget widget-our-services ">
      <div class="widget-content">
        <ul class="our-services">

          <li class="service">
            <a class="link-to-service" href="#">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <div class="right-content">
                <b class="title">Free Shipping</b>
                <span class="subtitle">On Order Over $99</span>
                <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
              </div>
            </a>
          </li>

          <li class="service">
            <a class="link-to-service" href="#">
              <i class="fa fa-gift" aria-hidden="true"></i>
              <div class="right-content">
                <b class="title">Special Offer</b>
                <span class="subtitle">Get a gift!</span>
                <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
              </div>
            </a>
          </li>

          <li class="service">
            <a class="link-to-service" href="#">
              <i class="fa fa-reply" aria-hidden="true"></i>
              <div class="right-content">
                <b class="title">Order Return</b>
                <span class="subtitle">Return within 7 days</span>
                <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div><!-- Categories widget-->

    <div class="widget mercado-widget widget-product">
      <h2 class="widget-title">Latest Products</h2>
      <div class="widget-content">
        <ul class="products">
          @foreach ($latest as $la) 
          <li class="product-item">
            <div class="product product-widget-style">
              <div class="thumbnnail">
                <a href="{{route('detail',['id'=>$la->id])}}" title="{{ $la->name }}">
                  <figure><img src="{{ $la->images->first() ? asset('files/images/'.$la->images->first()->image) : asset('files/images/no-image.jpg')}}" alt=""></figure>
                </a>
              </div>
              <div class="product-info">
                <a href="{{route('detail',['id'=>$la->id])}}" class="product-name"><span>{{ $la->name }}</span></a>
                @if ($la->bumpprice) 
                <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($la->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp. {{number_format($la->bumpprice,0,",",".")}}</p></del></div>   
                @else
                <div class="wrap-price"><span class="product-price">Rp. {{number_format($la->price,0,",",".")}}</span></div>
                @endif
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div><!--end sitebar-->

  <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="wrap-show-advance-info-box style-1 box-in-site">
      <h3 class="title-box">Related Products</h3>
      <div class="wrap-products">
        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

          @foreach ($related as $l)
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
  </div>

</div><!--end row-->
@endsection

