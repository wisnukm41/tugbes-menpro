<div class="container">
    <div class="mid-section main-info-area">

        <div class="wrap-logo-top left-section">
            <a href="{{route('home')}}" class="link-to-home"><img src="{{ asset('user-assets/images/logo.jpg')}}" alt="Logo"></a>
        </div>

        <div class="wrap-search center-section">
            <div class="wrap-search-form">
                <form action="{{route('shop-type',['type'=>'result'])}}" id="form-search-top" name="form-search-0top" method="GET">
                    <input type="text" name="search" value="" placeholder="Search here...">
                    <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>

        <div class="wrap-icon right-section">
            @auth
            <div class="wrap-icon-section wishlist">
                <a href="{{route('wishlist')}}" class="link-direction">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <div class="left-info">
                        <span class="index">{{wishlist_count()}} item</span>
                        <span class="title">Wishlist</span>
                    </div>
                </a>
            </div>
            <div class="wrap-icon-section minicart">
                <a href="{{route('cart')}}" class="link-direction">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <div class="left-info">
                        <span class="index">{{cart_count()}} items</span>
                        <span class="title">CART</span>
                    </div>
                </a>
            </div>
            @endauth
       
            <div class="wrap-icon-section show-up-after-1024">
                <a href="#" class="mobile-navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>

    </div>
</div>