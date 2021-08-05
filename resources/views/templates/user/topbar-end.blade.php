<div class="nav-section header-sticky">

    <div class="primary-nav-section">
        <div class="container">
            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                <li class="menu-item home-icon">
                    <a href="{{route('home')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
                <li class="menu-item">
                    <a href="{{route('shop')}}" class="link-term mercado-item-title">Shop</a>
                </li>
                @auth
                <li class="menu-item">
                    <a href="{{route('cart')}}" class="link-term mercado-item-title">Cart</a>
                </li>
                <li class="menu-item">
                    <a href="{{route('order')}}" class="link-term mercado-item-title">Order</a>
                </li>
                @endauth
                <li class="menu-item">
                    <a href="{{route('user-messages')}}" class="link-term mercado-item-title">Contact Us</a>
                </li>																	
            </ul>
        </div>
    </div>
</div>