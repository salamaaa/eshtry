<main id="main" class="main-site left-sidebar">
    <div class="container">
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
        <style>
            .product-wish {
                position: absolute;
                top: 10%;
                left: 0;
                right: 30px;
                z-index: 99;
                text-align: right;
                padding-top: 0;
            }

            .product-wish .fa {
                color: #cbcbcb;
                font-size: 32px;
            }

            .product-wish .fa:hover {
                color: #ff0000;
            }

            .fill-heart {
                color: #ff0000 !important;
            }
        </style>
        <div class="row">
            @if(Cart::instance('wishlist')->content()->count() > 0 )
                <ul class="product-list grid-products equal-container">
                    @forelse(Cart::instance('wishlist')->content() as $item)
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumbnail">
                                    <a href="{{route('product.details',$item->model->slug)}}"
                                       title="{{$item->model->name}}">
                                        <figure>
                                            <img src="{{asset('assets/images/products/'.$item->model->image)}}"
                                                 alt="{{$item->model->name}}">
                                        </figure>
                                    </a>
                                </div>
                                <div class=" product-info">
                                    <a href="{{route('product.details',$item->model->slug)}}"
                                       class="product-name"><span>{{$item->model->name}}</span></a>
                                    @if($item->model->sale_price > 0)
                                        <div class="wrap-price">
                                            <ins><p class="product-price">${{$item->model->sale_price}}</p></ins>
                                            <del><p class="product-price">${{$item->model->regular_price}}</p></del>
                                        </div>
                                    @else
                                        <div class="wrap-price"><span
                                                class="product-price">${{$item->model->regular_price}}</span>
                                        </div>
                                    @endif
                                    <a href="#"
                                       class="btn add-to-cart"
                                       wire:click.prevent="moveFromWishlistToCart('{{$item->rowId}}')">
                                        Move To Cart
                                    </a>
                                    <div class="product-wish">
                                        <a href=""
                                           wire:click.prevent="deleteFromWishList({{$item->model->id}})">
                                            <i class="fa fa-heart fill-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <h4 style="padding-top: 30px">No Products Found</h4>
                    @endforelse
                </ul>
            @else
                <h4>No Products in the Wishlist yet!</h4>
            @endif
        </div>
    </div>
</main>
