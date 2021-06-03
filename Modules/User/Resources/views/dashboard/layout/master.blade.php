<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('user') }}">
               {{config('app.name')}}
            </a>
                <input class="form-control mr-sm-2" name="search" id="search" onkeyup="setData(this.value)" style="width:500px;border:0px;" type="text" placeholder="Search something special" aria-label="Search" autocomplete="none">
                <div class="search-div" name="search-div" id="search-div">

                </div>
            <h6 style="float:right;">Welcome, {{Auth::user()->name}}
               ({{(Auth::user()->type==0)?"Super Admin User":Auth::user()->Organization->name}})</h6>

        </div>
    </nav>
    <div>
        @if(Auth::user()->type==0)
            @include('user::dashboard.layout.admin.navbar')
        @else
            @include('user::dashboard.layout.normal.navbar')
        @endif
    </div>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script>
    function setData(val) {

        if((val.length)>0)
        {
            var search_div=document.getElementById("search-div")
            search_div.style.display="block";
            var url= '{{ url('search')."/"}}'+val;
            jQuery.ajax({
                url: url, method: 'get',success: function(result){

                    search_div.innerHTML=result;


                }
            });
        }
        if(val.length==0)
        {
            document.getElementById("search-div").style.display="none";
        }

    }

</script>

    <p style="margin: 0px 0px 0px 500px;">Developed By:Sandesh Lohani</p>
</body>
</html>
