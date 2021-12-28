@extends('user/layout')

@section('container')


<div class=" main-content-area">
    <div class="row">
        <ul class="product-list grid-products equal-container">
            <h3>All Medicines</h3>
            @foreach ($data as $list)
            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a href="productDetail/{{$list->id}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                            <figure><img src="{{asset('uploads/products/'.$list->imagePath)}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$list->product_name}}</span></a>
                        <div class="wrap-price"><span class="product-price">Offer: {{$list->sale_price}} Tk (Per Piece) </span></div>
                        <div class="wrap-price"><span class="product-price">Regular: {{$list->regular_price}} Tk (Per Piece) </span></div>
                        <a href="#" class="btn add-to-cart">Add To Cart</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
</div>

@endsection
