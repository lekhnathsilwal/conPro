@extends('employee::layouts.master')
@section('content')
    <div class="container">
        @include('common.flash')
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"><img style="margin-left: 50px;" src="{{url('assets/img/forget_password.gif')}}"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" action="{{route('employee.email.password')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Reset Password">

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
