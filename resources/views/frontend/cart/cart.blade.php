@extends('frontend.layouts.frontend_main_master')
@section('content')
<style>
    .quantity {
    padding-left: 87px;
}
</style>
<main class="main cart">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="active"><a href="cart.html">Shopping Cart</a></li>
                {{-- <li><a href="checkout.html">Checkout</a></li> --}}
                {{-- <li><a href="order.html">Order Complete</a></li> --}}
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg mb-10">
                <div class="col-lg-8 pr-lg-4 mb-6">
                    <table class="shop-table cart-table">
                        <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th></th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-quantity"><span>Quantity</span></th>
                                <th class="product-subtotal"><span>Subtotal</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalprice = 0;
                            @endphp
                            @foreach($products as $product)
                                <tr>
                                    <td class="product-thumbnail">
                                        <div class="p-relative">
                                            <a href="#">
                                                <figure>
                                                    <img src="{{ asset($product->product_image) }}" alt="product"
                                                        width="300" height="338">
                                                </figure>
                                            </a>
                                            <button type="submit" class="btn btn-close" onclick="cartdelete({{ $product->id }});"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <a href="product-default.html">
                                            {{ $product->product_name }}
                                        </a>
                                    </td>
                                    <td class="product-price"><span class="amount">AED {{ $product->product_price }}</span></td>
                                    <td class="product-quantity">
                                        {{-- <div class="input-group">
                                            <input class="quantity form-control" type="number" min="1" max="100000">
                                            <button class="quantity-plus w-icon-plus"></button>
                                            <button class="quantity-minus w-icon-minus"></button>
                                        </div> --}}
                                        <span class="quantity" style="padding-left: 87px;">{{ $product->qty }}</span>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount" id="cart_productprices">AED {{ $product->product_price *  $product->qty}}</span>
                                            @php 
                                                $totalprice += $product->product_price *  $product->qty;
                                            @endphp
                                            
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="product-default.html">
                                            <figure>
                                                <img src="{{ asset('assets/frontend/assets/images/shop/13.jpg') }}" alt="product"
                                                    width="300" height="338">
                                            </figure>
                                        </a>
                                        <button class="btn btn-close"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="product-default.html">
                                        Smart Watch
                                    </a>
                                </td>
                                <td class="product-price"><span class="amount">₹60.00</span></td>
                                <td class="product-quantity">
                                    <div class="input-group">
                                        <input class="quantity form-control" type="number" min="1" max="100000">
                                        <button class="quantity-plus w-icon-plus"></button>
                                        <button class="quantity-minus w-icon-minus"></button>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="amount">₹60.00</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>

                    <div class="cart-action mb-6">
                        <a href="{{ route('homeview'); }}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                        {{-- <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button> 
                        <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> --}}
                    </div>

                    {{-- <form class="coupon">
                        <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                        <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..." required />
                        <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
                    </form> --}}
                </div>
                <div class="col-lg-4 sticky-sidebar-wrapper">
                    <div class="sticky-sidebar">
                        <div class="cart-summary mb-4">
                            <h3 class="cart-title text-uppercase">Cart Totals</h3>
                            {{-- <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                <label class="ls-25">Subtotal</label>
                                   
                                <span>AED {{ $totalprice }}</span>
                            </div> --}}

                            {{-- <hr class="divider"> --}}

                            {{-- <ul class="shipping-methods mb-2">
                                <li>
                                    <label
                                        class="shipping-title text-dark font-weight-bold">Shipping</label>
                                </li>
                                <li>
                                    <div class="custom-radio">
                                        <input type="radio" id="free-shipping" class="custom-control-input"
                                            name="shipping">
                                        <label for="free-shipping"
                                            class="custom-control-label color-dark">Free
                                            Shipping</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-radio">
                                        <input type="radio" id="local-pickup" class="custom-control-input"
                                            name="shipping">
                                        <label for="local-pickup"
                                            class="custom-control-label color-dark">Local
                                            Pickup</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-radio">
                                        <input type="radio" id="flat-rate" class="custom-control-input"
                                            name="shipping">
                                        <label for="flat-rate" class="custom-control-label color-dark">Flat
                                            rate:
                                            ₹5.00</label>
                                    </div>
                                </li>
                            </ul> --}}

                            {{-- <div class="shipping-calculator">
                                <p class="shipping-destination lh-1">Shipping to <strong>CA</strong>.</p>

                                <form class="shipping-calculator-form" name="cartdetails" id="cartdetails">
                                    @csrf
                                    <div class="form-group">
                                        <div class="select-box">
                                            <select name="country" class="form-control form-control-md">
                                                <option value="default" selected="selected">United States
                                                    (US)
                                                </option>
                                                <option value="us">United States</option>
                                                <option value="uk">United Kingdom</option>
                                                <option value="fr">France</option>
                                                <option value="aus">Australia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <select name="state" class="form-control form-control-md">
                                                <option value="default" selected="selected">California
                                                </option>
                                                <option value="ohaio">Ohaio</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" title="Name is required"
                                            name="customer_name" id="customer_name" placeholder="Enter your name">
                                            <span class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" title="mobile number is required"
                                            name="customer_number" id="customer_number" placeholder="Enter your mobile number">
                                            <span class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="email" title="email is required"
                                            name="customer_email" id="customer_email" placeholder="Enter your email id">
                                            <span class="error"></span>
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-outline btn-rounded">Update
                                        Totals</button>
                                
                            </div> --}}

                            <hr class="divider mb-6">
                            <form action="" name="checkout">
                                @csrf
                            <div class="order-total d-flex justify-content-between align-items-center">
                                <label>Total</label>
                                <span class="ls-50">AED {{ $totalprice }}</span>
                                <input type="hidden" name="hdtotalprice" value="{{ $totalprice }}" id="hdtotalprice">
                            </div>
                            <button   type="submit"
                                class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></button >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
@endsection
@section('footer')
    <script src="{{ asset('assets/frontend/assets/js/cart/cart.js') }}"></script>
@endsection