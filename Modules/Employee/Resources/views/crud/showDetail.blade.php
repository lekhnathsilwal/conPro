@extends('user::dashboard.layout.master')
@section('content')
    <div class="container">

        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Employee Detail of '.$data->name) }}<span style="float: right">
                @if(count($permission)>0)
                        @if(array_key_exists('Employee',$permission[0]['module']))
                                @if($permission[0]['module']['Employee']['edit']==1 || $data->created_by==Auth::id())

                                    <a href="{{route('employee.edit',['id'=>$data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;

                                @endif


                                @if($permission[0]['module']['Employee']['delete']==1 || $data->created_by==Auth::id())

                                    <a href="{{route('employee.delete',['id'=>$data->id])}}"><i class="fa fa-times-circle">&nbsp;Delete</i></a>

                                @endif

                        @endif
                    @endif
                    @if(Auth::user()->type==0)

                        <a href="{{route('employee.delete',['id'=>$data->id])}}"><i class="fa fa-times-circle">&nbsp;Delete</i></a>


                    @endif
            &nbsp; </span></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">

                                    <div class="userData ml-3">
                                        <img src="{{($data->image!=null)?asset('assets/img/profile-photos/'.$data->image):asset('assets/img/no-pic.jpg')}}" style="height:200px;"/>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="generalInfo-tab" data-toggle="tab" href="#generalInfo" role="tab" aria-controls="generalInfo" aria-selected="true">General Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel" aria-labelledby="generalInfo-tab">


                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Employee Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->name}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Email</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->email}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Address</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->address}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Contact</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->contact}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Gender</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    @if($data->gender==0)
                                                        Male
                                                    @elseif($data->gender==1)
                                                        Female
                                                    @else
                                                        Other
                                                    @endif
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Date of Birth</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->dob}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Organization</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->Organization->name}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Department</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{($data->departments_id==null)?'Overall':$data->Department->name}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Joined Date</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->joined_date}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Status</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{($data->verified==1)?'Verified':'Not Verified'}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Designation</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->designation}}
                                                </div>
                                            </div>
                                            <hr />


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Employee Created By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <a href="{{route('user.detail',['id'=>$data->created_by])}}">{{($data->created_by!=null)?$data->emp_created_by->name:''}}</a>
                                                </div>
                                            </div>
                                            <hr />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
