<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $result['data'] = Product:: All();
        return view('user.shop', $result);
    }

    public function login(){
        return view('user.login');
    }

    public function login_user(Request $request){
        $email = $request->post('email');
        $password = $request->post('password');

        $result = User::where(['email'=>$email])->first();
        if(isset($result)){
            if($request->post('password') == $result->password) {
                $request->session()->put('USER_LOGIN', true);
                $request->session()->put('USER_ID', $result->id);
                $request->session()->put('USER_NAME', $result->name);
                $request->session()->put('USER_EMAIL', $result->email);
                return redirect('/');
            }else{
                $request->session()->flash('error', 'Please enter correct password');
                return redirect('login');
            }

        }else{
            $request->session()->flash('error', 'Please enter valid credentials');
            return redirect('login');
        }
    }

    public function register(){
        return view('user.register');
    }

    public function add_user(Request $request){

        //return $request->post();
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = $request->post('password');

        $user->save();

        $request->session()->flash('message', 'User Added Successfully. Please login now');
        return redirect('login');
    }

    public function cart(Request $request){
        return view('user.cart');
    }

    public function checkout(Request $request){
        return view('user.checkout');
    }

}
