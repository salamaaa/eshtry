<div class="wrap-icon-section minicart">
    <a href="{{route('cart')}}" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        @if(Cart::instance('cart')->count() > 0)
            <div class="left-info">
                <span class="index">{{Cart::instance('cart')->count()}} items</span>
                <span class="title">CART</span>
            </div>
        @endif
    </a>
</div>
