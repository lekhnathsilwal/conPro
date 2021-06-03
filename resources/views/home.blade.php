@extends('user::login.layout.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login in Applications as</div>

                <div class="card-body">
                    <a href="{{route('user.home')}}">
                    <div class="col-md-4">
                        <p>User Login</p>
                    </div></a>
                    <a href="{{route('employee.login')}}">
                    <div class="col-md-4">
                        <p>Employee Login</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
