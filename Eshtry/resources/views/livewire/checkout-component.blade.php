<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Billing Address</h3>
                        <div class="billing-address"></div>
                        <p class="row-in-form">
                            <label for="fname">first name<span>*</span></label>
                            <input id="fname" type="text" name="fname" value="" wire:model="fname"
                                   placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="lname">last name<span>*</span></label>
                            <input id="lname" type="text" name="lname" value="" wire:model="lname"
                                   placeholder="Your last name">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email Addreess:</label>
                            <input id="email" type="email" name="email" value="" wire:model="email"
                                   placeholder="Type your email">
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input id="phone" type="number" name="phone" value="" wire:model="mobile"
                                   placeholder="10 digits format">
                        </p>
                        <p class="row-in-form">
                            <label for="add">Line 1:</label>
                            <input id="add" type="text" name="add" value="" wire:model="line1"
                                   placeholder="Street at apartment number">
                        </p>
                        <p class="row-in-form">
                            <label for="add">Line 2:</label>
                            <input id="add" type="text" name="add" value="" wire:model="line2"
                                   placeholder="Street at apartment number">
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input id="country" type="text" name="country" value="" wire:model="country"
                                   placeholder="United States">
                        </p>

                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input id="city" type="text" name="city" value="" wire:model="city" placeholder="City name">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Province<span>*</span></label>
                            <input id="city" type="text" name="city" value="" wire:model="province"
                                   placeholder="City name">
                        </p>
                        <p class="row-in-form">
                            <label for="zip-code">Postcode / ZIP:</label>
                            <input id="zip-code" type="number" name="zip-code" value="" wire:model="zipcode"
                                   placeholder="Your postal code">
                        </p>
                        <p class="row-in-form fill-wife">
                            <label class="checkbox-field">
                                <input name="different-add" id="different-add" value="1" type="checkbox"
                                       wire:model="ship_to_different_address">
                                <span>Ship to a different address?</span>
                            </label>
                        </p>
                    </div>
                </div>
                @if($ship_to_different_address)
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Shipping Address</h3>
                            <div class="billing-address"></div>
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input id="fname" type="text" name="fname" value="" wire:model="s_fname"
                                       placeholder="Your name">
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input id="lname" type="text" name="lname" value="" wire:model="s_lname"
                                       placeholder="Your last name">
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Address:</label>
                                <input id="email" type="email" name="email" value="" wire:model="s_email"
                                       placeholder="Type your email">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input id="phone" type="number" name="phone" value="" wire:model="s_mobile"
                                       placeholder="10 digits format">
                            </p>
                            <p class="row-in-form">
                                <label for="add">Line 1:</label>
                                <input id="add" type="text" name="add" value=""
                                       wire:model="s_line1" placeholder="Street at apartment number">
                            </p>
                            <p class="row-in-form">
                                <label for="line2">Line 2:</label>
                                <input id="line2" type="text" name="add" value=""
                                       wire:model="s_line2" placeholder="Street at apartment number">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input id="country" type="text" name="country" value="" wire:model="s_country"
                                       placeholder="United States">
                            </p>
                            <p class="row-in-form">
                                <label for="province">Province<span>*</span></label>
                                <input id="province" type="text" name="province" value="" wire:model="s_country"
                                       placeholder="Province">
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input id="city" type="text" name="city" value="" wire:model="s_city"
                                       placeholder="City name">
                            </p>
                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input id="zip-code" type="number" name="zip-code" value=""
                                       wire:model="s_zipcode" placeholder="Your postal code">
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="summary summary-checkout">
            <div class="summary-item payment-method">
                <h4 class="title-box">Payment Method</h4>
                <p class="summary-info"><span class="title">Check / Money order</span></p>
                <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                <div class="choose-payment-methods">
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-bank" value="cod" type="radio">
                        <span>Cash on Delivery</span>
                        <span class="payment-desc">Buy now Pay on Delivery</span>
                    </label>
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-visa" value="card" type="radio">
                        <span>Debit / Credit Card</span>
                        <span
                            class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                    </label>
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                        <span>Paypal</span>
                        <span class="payment-desc">You can pay with your credit</span>
                        <span class="payment-desc">card if you don't have a paypal account</span>
                    </label>
                </div>
                <p class="summary-info grand-total"><span>Grand Total</span> <span
                        class="grand-total-price">$100.00</span></p>
                <a href="thankyou.html" class="btn btn-medium">Place order now</a>
            </div>
            <div class="summary-item shipping-method">
                <h4 class="title-box f-title">Shipping method</h4>
                <p class="summary-info"><span class="title">Flat Rate</span></p>
                <p class="summary-info"><span class="title">Fixed $0</span></p>
            </div>
        </div>
    </div>
    </div>
</main>
