<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="wrap-item-in-cart">
                @if(\Illuminate\Support\Facades\Session::has('success_message'))
                    <div class="alert alert-success">
                        <strong>{{\Illuminate\Support\Facades\Session::get('success_message')}}</strong>
                    </div>
                @endif

                @if(Cart::instance('cart')->count() > 0)
                    <h3 class="box-title">Product Name</h3>
                    <ul class="products-cart">
                        @foreach(Cart::instance('cart')->content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <a href="{{route('product.details',$item->model->slug)}}">
                                        <figure><img src="{{asset('assets/images/products/'.$item->model->image)}}"
                                                     alt="{{$item->model->name}}"></figure>
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                       href="{{route('product.details',$item->model->slug)}}">{{$item->model->name}}</a>
                                </div>
                                <div class="price-field product-price">
                                    @if($item->model->sale_price > 0)
                                        <p class="price">
                                            ${{$item->model->sale_price}}
                                        </p>
                                    @else
                                        <p class="price">
                                            ${{$item->model->regular_price}}
                                        </p>
                                    @endif
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quantity" value="{{$item->qty}}"
                                               data-max="120" pattern="[0-9]*">
                                        <a class="btn btn-increase"
                                           href="#"
                                           wire:click.prevent="increaseQty('{{$item->rowId}}')"></a>
                                        <a class="btn btn-reduce"
                                           href="#"
                                           wire:click.prevent="decreaseQty('{{$item->rowId}}')"></a>
                                    </div>
                                    <div class="text-center">
                                        <a href="#"
                                           wire:click.prevent="saveForLater('{{$item->rowId}}')">
                                            Save for Later
                                        </a>
                                    </div>
                                </div>
                                <div class="price-field sub-total">
                                    <p class="price">${{$item->subtotal}}</p></div>
                                <div class="delete">
                                    <a href="#"
                                       class="btn btn-delete"
                                       title="remove {{$item->model->name}}"
                                       wire:click.prevent="removeItem('{{$item->rowId}}')">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="font-bold text-xl">Cart is Empty!!</p>
                @endif
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b
                            class="index">${{Cart::instance('cart')->subtotal()}}</b></p>
                    @if(Session::has('coupon'))
                        <p class="summary-info"><span class="title">Discount ({{Session::get('coupon')['code']}}) <a
                                    href="#" title="remove coupon" wire:click.prevent="removeCoupon()"><i class="fa fa-times-circle text-danger"></i></a> </span><b
                                class="index">- ${{number_format($discount,2)}}</b></p>
                        <p class="summary-info"><span class="title">Tax ({{config('cart.tax')}}%)</span><b
                                class="index">${{number_format($taxAfterDiscount,2)}}</b></p>
                        <p class="summary-info"><span class="title">Subtotal with Discount</span><b
                                class="index">${{number_format($subtotalAfterDiscount,2)}}</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">${{number_format($totalAfterDiscount,2)}}</b></p>
                    @else
                        <p class="summary-info"><span class="title">Tax</span><b
                                class="index">${{Cart::instance('cart')->tax()}}</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b>
                        </p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">${{Cart::instance('cart')->total()}}</b></p>
                    @endif
                </div>
                <div class="checkout-info">
                    @if(!Session::has('coupon'))
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox"
                                   wire:model="haveCouponCode"><span>I have a coupon  code</span>
                        </label>
                        @if($haveCouponCode)
                            <div class="summary-item">
                                <form wire:submit.prevent="applyCouponCode()">
                                    <h4 class="title-box">Coupon Code</h4>
                                    @if(\Illuminate\Support\Facades\Session::has('coupon_message'))
                                        <div class="alert alert-danger">
                                            <strong>{{\Illuminate\Support\Facades\Session::get('coupon_message')}}</strong>
                                        </div>
                                    @endif
                                    <p class="row-in-form">
                                        <label for="coupon-code">Enter ur coupon code:</label>
                                        <input type="text" wire:model="couponCode">
                                        <button type="submit" class="btn btn-sm">Apply</button>
                                    </p>
                                </form>
                            </div>
                        @endif
                    @endif
                    <a class="btn btn-checkout" href="{{route('checkout')}}">Check out</a>
                    <a class="link-to-shop"
                       href="{{route('shop')}}">
                        Continue Shopping
                        <i class="fa fa-arrow-circle-right"
                           aria-hidden="true">
                        </i>
                    </a>
                </div>

                <div class="update-clear">
                    <a class="btn btn-clear"
                       href="#"
                       wire:click.prevent="removeAllItems()">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>

            <div class="wrap-item-in-cart">
                <h3 class="title-box"
                    style="border-bottom: 1px solid;padding-bottom: 15px;">{{Cart::instance('save_for_later')->count()}}
                    item(s) Saved For Later</h3>
                @if(\Illuminate\Support\Facades\Session::has('success_message_later'))
                    <div class="alert alert-success">
                        <strong>{{\Illuminate\Support\Facades\Session::get('success_message_later')}}</strong>
                    </div>
                @endif

                @if(Cart::instance('save_for_later')->count() > 0)
                    <h3 class="box-title">Product Name</h3>
                    <ul class="products-cart">
                        @foreach(Cart::instance('save_for_later')->content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <a href="{{route('product.details',$item->model->slug)}}">
                                        <figure><img src="{{asset('assets/images/products/'.$item->model->image)}}"
                                                     alt="{{$item->model->name}}"></figure>
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                       href="{{route('product.details',$item->model->slug)}}">{{$item->model->name}}</a>
                                </div>
                                <div class="price-field product-price">
                                    @if($item->model->sale_price > 0)
                                        <p class="price">
                                            ${{$item->model->sale_price}}
                                        </p>
                                    @else
                                        <p class="price">
                                            ${{$item->model->regular_price}}
                                        </p>
                                    @endif
                                </div>
                                <div class="quantity">
                                    <div class="text-center">
                                        <a href="#"
                                           wire:click.prevent="moveToCart('{{$item->rowId}}')">
                                            Move to Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="delete">
                                    <a href="#"
                                       class="btn btn-delete"
                                       title="remove {{$item->model->name}}"
                                       wire:click.prevent="deleteFormSavedForLater('{{$item->rowId}}')">
                                        <span>Delete from your Saved List</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="font-bold text-xl">Saved for Later List is Empty!!</p>
                @endif
            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Most Viewed Products</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                         data-loop="false" data-nav="true" data-dots="false"
                         data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_04.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_17.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price">
                                    <ins><p class="product-price">$168.00</p></ins>
                                    <del><p class="product-price">$250.00</p></del>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_15.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price">
                                    <ins><p class="product-price">$168.00</p></ins>
                                    <del><p class="product-price">$250.00</p></del>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_01.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_21.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_03.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price">
                                    <ins><p class="product-price">$168.00</p></ins>
                                    <del><p class="product-price">$250.00</p></del>
                                </div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_04.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumbnail">
                                <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{asset('assets/images/products/digital_05.jpg')}}" width="214"
                                                 height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

