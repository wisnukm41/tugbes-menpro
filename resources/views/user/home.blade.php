@extends('layouts.user')

@section('content')
    <!--MAIN SLIDE-->
    <div class="wrap-main-slide">
        <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
            <div class="item-slide">
                <img src="{{ asset('user-assets/images/main-slider-1-1.jpg')}}" alt="" class="img-slide">
                <div class="slide-info slide-1">
                    <h2 class="f-title">Kid Smart <b>Watches</b></h2>
                    <span class="subtitle">Compra todos tus productos Smart por internet.</span>
                    <p class="sale-info">Only price: <span class="price">$59.99</span></p>
                    <a href="#" class="btn-link">Shop Now</a>
                </div>
            </div>
            <div class="item-slide">
                <img src="{{ asset('user-assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">
                <div class="slide-info slide-2">
                    <h2 class="f-title">Extra 25% Off</h2>
                    <span class="f-subtitle">On online payments</span>
                    <p class="discount-code">Use Code: #FA6868</p>
                    <h4 class="s-title">Get Free</h4>
                    <p class="s-subtitle">Transparent Bra Straps</p>
                </div>
            </div>
            <div class="item-slide">
                <img src="{{ asset('user-assets/images/main-slider-1-3.jpg')}}" alt="" class="img-slide">
                <div class="slide-info slide-3">
                    <h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
                    <span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
                    <p class="sale-info">Stating at: <b class="price">$225.00</b></p>
                    <a href="#" class="btn-link">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!--Latest Products-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Latest Products</h3>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">						
                <div class="tab-contents">
                    <div class="tab-content-item active" id="digital_1a">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                            @foreach ($latest as $l)
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
                    </div>							
                </div>
            </div>
        </div>
    </div>

    <!--Product Categories-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Product Type</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{ asset('user-assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-control">
                    <a href="#type_1" class="tab-control-item active">Raw Ingredient</a>
                    <a href="#type_2" class="tab-control-item">Ready To Consume</a>
                    <a href="#type_3" class="tab-control-item">Extra</a>
                </div>
                <div class="tab-contents">
    
                    <div class="tab-content-item active" id="type_1">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                            @foreach ($p_raw as $pr)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="#" title="{{ $pr->name }}">
                                            <figure><img src="{{ $pr->images->first() ? asset('files/images/'.$pr->images->first()->image) : asset('files/images/no-image.jpg')}}" width="800" height="800" alt="{{ $pr->name }}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            @if (str_contains($pr->tags,'new'))
                                                <span class="flash-item new-label">new</span> 
                                            @endif
                                            @if ($pr->bumpprice) 
                                                <span class="flash-item sale-label">sale</span>
                                            @endif
                                            @if (str_contains($pr->tags,'bs'))
                                                <span class="flash-item bestseller-label">Bestseller</span>
                                            @endif
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$pr->name}}</span></a>
                                        <div class="product-rating">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        @if ($pr->bumpprice)
                                        <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($pr->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp.{{number_format($pr->bumpprice,0,",",".")}}</p></del></div>   
                                        @else
                                        <div class="wrap-price"><span class="product-price">Rp. {{number_format($pr->price,0,",",".")}}</span></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                    <div class="tab-content-item" id="type_2">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @foreach ($p_fin as $pf)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="{{ $pf->name }}">
                                        <figure><img src="{{ $pf->images->first() ? asset('files/images/'.$pf->images->first()->image) : asset('files/images/no-image.jpg')}}" width="800" height="800" alt="{{ $pf->name }}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        @if (str_contains($pf->tags,'new'))
                                            <span class="flash-item new-label">new</span> 
                                        @endif
                                        @if ($pf->bumpprice) 
                                            <span class="flash-item sale-label">sale</span>
                                        @endif
                                        @if (str_contains($pf->tags,'bs'))
                                            <span class="flash-item bestseller-label">Bestseller</span>
                                        @endif
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{$pf->name}}</span></a>
                                    <div class="product-rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    @if ($pf->bumpprice)
                                    <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($pf->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp.{{number_format($pf->bumpprice,0,",",".")}}</p></del></div>   
                                    @else
                                    <div class="wrap-price"><span class="product-price">Rp. {{number_format($pf->price,0,",",".")}}</span></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach 
                            
                        </div>
                    </div>
    
                    <div class="tab-content-item" id="type_3">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
    
                            @foreach ($p_ext as $pe)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="{{ $pe->name }}">
                                        <figure><img src="{{ $pe->images->first() ? asset('files/images/'.$pe->images->first()->image) : asset('files/images/no-image.jpg')}}" width="800" height="800" alt="{{ $pe->name }}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        @if (str_contains($pe->tags,'new'))
                                            <span class="flash-item new-label">new</span> 
                                        @endif
                                        @if ($pe->bumpprice) 
                                            <span class="flash-item sale-label">sale</span>
                                        @endif
                                        @if (str_contains($pe->tags,'bs'))
                                            <span class="flash-item bestseller-label">Bestseller</span>
                                        @endif
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{$pe->name}}</span></a>
                                    <div class="product-rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    @if ($pe->bumpprice)
                                    <div class="wrap-price"><ins><p class="product-price">Rp. {{number_format($pe->price,0,",",".")}}</p></ins> <del><p class="product-price">Rp.{{number_format($pe->bumpprice,0,",",".")}}</p></del></div>   
                                    @else
                                    <div class="wrap-price"><span class="product-price">Rp. {{number_format($pe->price,0,",",".")}}</span></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach 
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>		
@endsection