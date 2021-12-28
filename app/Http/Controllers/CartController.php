<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
                    ->where(['carts.user_id' => session('USER_ID'),'carts.order_active' =>'false'])
                    ->get(['carts.product_id','products.product_name', 'products.imagePath', 'products.sale_price', 'carts.amount', 'carts.price']);

        // echo $result;
        $sum =0;
        foreach ($result['data'] as $list){
            $sum += $list->price;
        }
        $result['sum'] = $sum;
        return view('user.cart', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_cart(Request $request, $id='', $change)
    {
        $arr = Cart::where(['user_id' => session('USER_ID'), 'product_id'=> $id, 'order_active'=>'false'])->get();

        $product = Product::find($id);

        if (sizeof($arr)==0){
            $cart = new Cart();
            $cart->amount = 1;
            $cart->user_id = session('USER_ID');
            $cart->product_id = $id;
            $cart->order_active = "false";
            $cart->order_id = 0;
            $cart->price = $product->sale_price * $cart->amount;

        }else{
            $cart = $arr['0'];
            if ($change=="reduce"){
                $cart->amount -= 1;
            }else{
                $cart->amount += 1;
            }
            $cart->price = $product->sale_price * $cart->amount;
        }

        $cart->save();
        if ($change == "nutral"){
            $request->session()->flash('message', "Product Added to Cart");
            return redirect('/');
        }else{
            return redirect('cart');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_cart(Request $request, $id)
    {
        if ($id>0){
            $cart = Cart::where(['user_id' => session('USER_ID'), 'product_id'=> $id])->delete();
        }
        return redirect('cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, $sum){
        $result['sum'] = $sum;
        return view('user.checkout', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
