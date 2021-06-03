@extends('user::dashboard.layout.master')
<style>

    .col-md-4
    {
        border: 1px green solid;
        border-radius: 10px;
        padding: 10px;
        width: 30%;
        margin:10px 0px 0px 10px;
        max-height: 130px;
    }
    .col-md-4 img
    {
        height: 100px;
        float:left;
        max-width: 45%;
    }
    .col-md-4 p
    {
        padding-left: 130px;
        font-size: medium;
    }

</style>
@section('content')


    <div class="container">
        <div class="table-responsive">
            @include('common.flash')
            <h4>Organization List</h4>
        </div>
        <div class="row">
            @if(count($organization)>0)
                @foreach($organization as $org_data)
                    <div class="col-md-4" id="org_inf">
                        <img src="{{   ($org_data->image!=null) ? url('/assets/images/org-logo/'.$org_data->image)   :  url('/assets/images/user-img/no-img.jpg')}}">
                        <p>
                            <strong>{{$org_data->name}}</strong><br>
                            {{$org_data->email}}<br>
                            Created By:<a href="{{route('user.detail',['id'=>$org_data->created_by])}}">{{($org_data->created_by!=null)?$org_data->OrganizationCreatedBy->name:''}}</a>
                            <a href="{{route('organization.edit',['id'=>$org_data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;&nbsp;
                            <a href="{{route('organization.delete',['id'=>$org_data->id])}}"><i class="fa fa-edit">&nbsp;Delete</i></a><br>
                        </p>
                    </div>
                @endforeach
            @else
            <p>No Records Found !</p>
            @endif
        </div>
        {{$organization->links()}}
    </div>


@endsection
