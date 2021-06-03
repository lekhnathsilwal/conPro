@extends('user::dashboard.layout.master')
@section('content')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @include('common.flash')

                <div class="card-header">{{ __('User Manual') }}
                    <a href="{{route('manual.show')}}" style="float: right" class="btn btn-primary">View Manual</a>
                </div>

                <div class="card-body">
                    <form action="{{route('manual.edit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <textarea name="manual" style="width: 100%">
                                {{$data->content}}
                            </textarea>
                            <script>
                                CKEDITOR.replace( 'manual' );
                            </script>
                    <br>
                        Upload File &nbsp;<input type="file" class="form-control" name="file">
                        <br>
                        @if($data->url!=null)
                        <a style="color: red" href="{{url('assets/manual/'.$data->url)}}">Open Existing Manual</a><br><br>
                        @endif

                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>


                    </form>
                    </div>

                </div>
            </div>
    </div>
    </div>

@endsection
