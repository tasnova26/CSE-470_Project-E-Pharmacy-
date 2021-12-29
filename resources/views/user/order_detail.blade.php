@extends('user/layout')

@section('container')

<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="#" class="link">home</a></li>
        <li class="item-link"><span>login</span></li>
    </ul>
</div>
<div class=" main-content-area shopping-cart">

    <div class="wrap-iten-in-cart">
        <h3 class="box-title">Order Details</h3>

        <ul class="products-cart">
            @foreach ($data as $list)

            <li class="pr-cart-item">
                <div class="product-image">
                    <figure><img src="{{asset('uploads/products/'.$list->imagePath)}}" alt=""></figure>
                </div>
                <div class="product-name">
                    <a class="link-to-product" href="#">{{$list->product_name}}</a>
                </div>
                <div class="price-field produtc-price"><p class="price">{{$list->sale_price}} Tk (Per Unit Price)</p></div>
                
                <div class="price-field sub-total"><p class="price">  X  </p></div>
                <div class="price-field sub-total"><p class="price"> {{$list->amount}} (Unit)</p></div>
                    
               

                <div class="price-field sub-total"><p class="price">= {{$list->price}} Tk</p></div>
                
            </li>
            @endforeach

        </ul>
    </div>

    <div class="summary">
        <div class="order-summary">
            <h4 class="title-box">Order Summary</h4>
            <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{$sum}} Tk</b></p>
            <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
            <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{$sum}} Tk</b></p>
        </div>
       
    </div>
</div>

@endsection
