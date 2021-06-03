@extends('user::login.layout.master')
@section('content')
<div class="container">
    @include('common.flash')
    <div class="row">
        <div class="col-lg-4">
                <div class="card">
                    <div class="card-header"><h4>Version Information</h4></div>
                    <div class="card-body">
                        <p>Laravel Framework Version : 5.7.28</p>
                        <p>Composer Version : 1.9.1</p>
                        <p>PHP Version : 7.1.32 </p>
                        <p>Zend Engine : v3.1.0</p>
                        <p>Apache/2.4.27 (Unix) OpenSSL/1.0.1p PHP/7.1.8</p>
                        <p>Database client version: libmysql - 5.6.37</p>
                        <p>Server type: MySQL</p>
                        <p>Server version: 5.6.37 - Source distribution</p>
                    </div>

            </div>
        </div>
        <div class="col-lg-6">

<div class="login-form" style="margin-top:100px; ">

    <form action="{{route('user.login')}}" method="post">
        @csrf
        <h2 class="text-center">Login Panel</h2>
        <div class="form-group">
            <small>Please Enter Username eg:<b>admin</b> for email admin@lohaninbrothers.com</small>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required="required">
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox" value="true" name="remember"> Remember me</label>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>

    </form>
    <p class="text-center"><a href="{{route('user.forget.password')}}" class="pull-right">Forgot Password?</a></p>
</div>

        </div> </div></div>
@endsection
