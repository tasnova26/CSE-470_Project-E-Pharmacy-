@extends('user/layout')

@section('container')


<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="#" class="link">home</a></li>
        <li class="item-link"><span>Register</span></li>
    </ul>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="register-form form-item ">
                    <form class="form-stl" action="{{route('user.register')}}" name="frm-login" method="post" >
                        @csrf
                        <fieldset class="wrap-title">
                            <h3 class="form-title">Create an account</h3>
                            <h4 class="form-subtitle">Personal infomation</h4>
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-reg-lname">Name*</label>
                            <input type="text" id="name" name="name" placeholder="Last name*" required>
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-reg-email">Email Address*</label>
                            <input type="email" id="email" name="email" placeholder="Email address" required>
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </fieldset>

                        <fieldset class="wrap-title">
                            <h3 class="form-title">Login Information</h3>
                        </fieldset>
                        <fieldset class="wrap-input item-width-in-half left-item ">
                            <label for="frm-reg-pass">Password *</label>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </fieldset>
                        <fieldset class="wrap-input item-width-in-half ">
                            <label for="frm-reg-cfpass">Confirm Password *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        </fieldset>
                        <input type="submit" class="btn btn-sign" value="Register" name="register">
                    </form>
                </div>
            </div>
        </div><!--end main products area-->
    </div>
</div><!--end row-->

@endsection
