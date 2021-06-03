@extends('user::dashboard.layout.master')
<style>
    #profile-image1 {
        cursor: pointer;
        width: 120px;
        border:2px solid #03b1ce ;}
    .tital{ font-size:16px; font-weight:500;}
    .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}
</style>
@section('content')
    <div class="container">
    @if($data->count()>0)
    <div class="card">
        @include('common.flash')

        <div class="card-header">{{ __('User Profile of '.$data->name) }}</div>
        <div class="panel-body">

            <div class="box box-info">

                <div class="box-body">
                    <div class="col-sm-6">
                        <div style="padding: 10px"> <img alt="User Pic" src="{{($data->image!=null)?asset('assets/images/user-img/'.$data->image):asset('assets/img/no-pic.jpg')}}" style="height: 200px;width: 200px" id="profile-image1" class="img-circle img-responsive">
                        </div>

                        <br>

                        <!-- /input-group -->
                    </div>
                    <div class="col-sm-6">
                        <h4 style="color:#00b1b1;">{{$data->name}} </h4></span>
                        @if($data->type==0)
                        <span><p>Super Admin</p></span>
                        @else
                            <span><p>{{$data->designation}}</p></span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">

                    <div class="col-sm-5 col-xs-6 tital " >User Role</div><div class="col-sm-7 col-xs-6 ">{{($data->type==0)?'Super Admin':$data->User_Role->Role->group}}</div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Full Name:</div><div class="col-sm-7 col-xs-6 ">{{$data->name}}</div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Email Address:</div><div class="col-sm-7"><a href="mailto:{{$data->email}}">{{$data->email}}</a></div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Contact:</div><div class="col-sm-7">{{$data->contact}}</div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    @if($data->organizations_id!=null)
                    <div class="col-sm-5 col-xs-6 tital " >Organization:</div><div class="col-sm-7">{{$data->Organization->name}}</div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Nationality:</div><div class="col-sm-7">Nepalese</div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    @if($data->created_by!=null)
                    <div class="col-sm-5 col-xs-6 tital " >Account Created By:</div><div class="col-sm-7"><a href="{{route('user.detail',['id'=>$data->created_by])}}">{{($data->created_by!=null)?$data->UserCreatedBy->name:''}}</a> </div>
                    @endif

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->



        </div>
    </div>
</div>
    @else
        <p>No Records found!</p>
        @endif
    </div>
@endsection
