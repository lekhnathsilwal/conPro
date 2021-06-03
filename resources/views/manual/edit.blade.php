@extends('user::dashboard.layout.master')
@section('content')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <div class="container">

    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Edit User Manual') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('manual.edit') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Group Name<span>*</span></label>

                        <div class="col-md-6">
                            <textarea name="manual"></textarea>
                            <script>
                                CKEDITOR.replace( 'manual' );
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
