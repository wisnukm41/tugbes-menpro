<div class="container">
    <div class="mid-section main-info-area">

        <div class="wrap-logo-top left-section">
            <a href="{{route('home')}}" class="link-to-home"><img src="{{ asset('user-assets/images/logo.jpg')}}" alt="Logo"></a>
        </div>

        <div class="wrap-search center-section">
            <div class="wrap-search-form">
                <form action="#" id="form-search-top" name="form-search-top">
                    <input type="text" name="search" value="" placeholder="Search here...">
                    <button form="form-search-top" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <div class="wrap-list-cate">
                        <input type="hidden" name="product-cate" value="0" id="product-cate">
                        <a href="#" class="link-control">All Category</a>
                        <ul class="list-cate">
                            <li class="level-1">All Category</li>
                            <li class="level-1">Bahan Dasar</li>
                            <li class="level-1">Siap Konsumsi</li>
                            <li class="level-1">Tambahan</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>

        <div class="wrap-icon right-section">
            <div class="wrap-icon-section wishlist">
                <a href="#" class="link-direction">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <div class="left-info">
                        <span class="index">0 item</span>
                        <span class="title">Wishlist</span>
                    </div>
                </a>
            </div>
            <div class="wrap-icon-section minicart">
                <a href="#" class="link-direction">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <div class="left-info">
                        <span class="index">4 items</span>
                        <span class="title">CART</span>
                    </div>
                </a>
            </div>
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