@extends('user::dashboard.layout.master')
@section('content')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('User Manual') }}
                        @if($data->url!=null)
                        <a href="{{url('assets/manual/'.$data->url)}}" style="float: right" class="btn btn-primary">View Manual File</a>
                        @endif
                    </div>

                    <div class="card-body">
                        {!!$data->content!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
