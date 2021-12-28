<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Product:: All();
        return view('admin/product', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request, $id='')
    {
        if ($id>0){
            $arr = Product::where(['id' => $id])->get();
            $result['product_name']=$arr['0']->product_name;
            $result['product_slug'] = $arr['0']->product_slug;
            $result['product_desc'] = $arr['0']->product_desc;
            $result['regular_price'] = $arr['0']->regular_price;
            $result['sale_price'] = $arr['0']->sale_price;
            $result['quantity'] = $arr['0']->quantity;
            $result['id'] = $arr['0']->id;

        }else{
            $result['product_name'] = '';
            $result['product_slug'] = '';
            $result['product_desc'] = '';
            $result['regular_price'] = '';
            $result['sale_price'] = '';
            $result['quantity'] = '';
            $result['id'] = 0;
        }

        return view('admin/manage_product', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {

        // return $request->post();
        $request->validate([
            'product_name'=>'required',
            'product_slug'=>'required|unique:products,product_slug,'.$request->post('id'),
            'product_desc'=>'required',
            'regular_price'=>'required',
            'sale_price'=>'required',
            'quantity'=>'required',
        ]);

        if($request->post('id')>0){
            $product = Product::find($request->post('id'));

            if($request->hasfile('image')){
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file ->move('uploads/products/', $filename);
                $product->imagePath= $filename;
            }
            $msg = "Medicine Updated Successfully";
        }else{
            $product = new Product();
            if($request->hasfile('image')){
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file ->move('uploads/products/', $filename);
                $product->imagePath= $filename;
            }else{
                $product->imagePath='default-medicine.jpg';
            }
            $msg = "Medicine Inserted Successfully";
        }

        $product->product_name= $request->post('product_name');
        $product->product_slug= $request->post('product_slug');
        $product->product_desc= $request->post('product_desc');
        $product->regular_price= $request->post('regular_price');
        $product->sale_price= $request->post('sale_price');
        $product->quantity= $request->post('quantity');

        $product->save();

        $request->session()->flash('message', $msg);
        return redirect('admin/product');


    }

    public function delete(Request $request, $id){
        $model = Product:: find($id);
        $model->delete();
        $request->session()->flash('message', 'Medicine Deleted');
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productDetail(Request $request, $id)
    {
        $product['product'] = Product:: find($id);
        return view('user.details', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
