@extends('admin/layout')

@section('container')

<h1 class="m-b-15">Manage Product</h1>

<a href="{{url('admin/product')}}">
    <button class="btn btn-success">All Products</button>
</a>
<div class="row m-t-30">
    <div class="col-md-6 offset-md-3">
    <div class="card">

        <div class="card-body">

            <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_name" class="control-label mb-1">Product Name</label>
                    <input id="product_name" value="{{$product_name}}" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('product_name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_slug" class="control-label mb-1">Product Slug</label>
                    <input id="product_slug" value="{{$product_slug}}" name="product_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('product_slug')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="product_desc" class="control-label mb-1">Product Description</label>
                    <textarea id="product_desc" name="product_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$product_desc}}</textarea>
                    @error('product_desc')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="regular_price" class="control-label mb-1">Regular Price</label>
                    <input id="regular_price" value="{{$regular_price}}" name="regular_price" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('regular_price')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sale_price" class="control-label mb-1">Sale Price</label>
                    <input id="sale_price" value="{{$sale_price}}" name="sale_price" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('sale_price')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity" class="control-label mb-1">Quantity</label>
                    <input id="quantity" value="{{$quantity}}" name="quantity" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    @error('quantity')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="control-label mb-1">Product Image</label>
                    <input id="image" name="image" type="file" class="form-control-file" aria-required="true" aria-invalid="false">
                    @error('product_image')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <input type="hidden" name="id" value="{{$id}}">
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

@endsection
