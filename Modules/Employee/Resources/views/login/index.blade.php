@extends('employee::layouts.master')
@section('content')
<div class="container">
@include('common.flash')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="{{asset("assets/img/emp_login.jpg")}}" style="margin: 20px 0px 0px 20px;"/>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Employee Login Panel</h1>
                                </div>
                                <form class="user" action="{{route('employee.login')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <small>Please Enter Username eg:<b>admin</b> for email admin@lohaninbrothers.com</small>
                                        <input type="text" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="clearfix">
                                    <label class="pull-left checkbox-inline"><input type="checkbox" value="true" name="remember"> Remember me</label>
                        
                                </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit">

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('employee.forget.password')}}">Forgot Password?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
