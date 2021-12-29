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
        <h3 class="box-title">Orders List</h3>

        <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>City</th>
                                <th>Delivery Status</th>
                                <th>Total Bill<br>(Per piece in BDT)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $list)
                            <tr>
                                <td>{{$list->created_at}}</td>
                                <td>{{$list->order_id}}</td>
                                <td>{{$list->lname}}</td>
                                <td>{{$list->phone}}</td>
                                <td>{{$list->city}}</td>
                                <td>{{$list->delivery}}</td>
                                <td>{{$list->bill}}</td>
                                <td>
                                <a href="order/delete/{{$list->order_id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                <a href="order/{{$list->order_id}}/false"><button type="button" class="btn btn-success">View Details</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
                </div>
            </div>
        </div>

</div>

@endsection
