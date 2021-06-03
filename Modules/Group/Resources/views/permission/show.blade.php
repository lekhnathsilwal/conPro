@extends('user::dashboard.layout.master')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('common.flash')
                @foreach($data['module'] as $moduleName)
                <div class="card-header">Permission on {{ __($moduleName) }} Module</div>

                <div class="card-body">

                    @if(array_key_exists($moduleName,$data))
                        @foreach($data[$moduleName] as $key=>$value)
                            @if($value==1)
                        <p>User is assigned to {{$key}} data on {{$moduleName}} </p>
                            @endif
                        @endforeach
                        @endif
                </div>
                    @endforeach
            </div>

@endsection
