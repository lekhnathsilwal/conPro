@extends('user::dashboard.layout.master')
<style>
    .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
    .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
    .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
</style>
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Upload Files for {{$data->name}} Project</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('file.upload',['id'=>$data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="file[]" id="poster" type="file" multiple>
                        <input type="submit"  value="Submit" class="btn btn-success">
                        <a href="{{route('project.show')}}" class="btn btn-success">Skip</a>
                        <small>Each File Size must be less than or equal to 500KB</small>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
