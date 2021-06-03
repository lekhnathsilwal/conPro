@extends('user::dashboard.layout.master')
@section('content')
<div class="container">

    <div class="card">
        @include('common.flash')

        <div class="card-header">{{ __('Project Detail of '.$data->name) }}<span style="float: right">
                @if(count($permission)>0)
                @if(array_key_exists('Project',$permission[0]['module']))
                    @if($data->created_by==Auth::id())
                        @if($permission[0]['module']['Project']['edit']==1)

                                <a href="{{route('project.edit',['id'=>$data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;

                        @endif


                        @if($permission[0]['module']['Project']['delete']==1)

                                <a href="{{route('project.delete',['id'=>$data->id])}}"><i class="fa fa-times-circle">&nbsp;Delete</i></a>

                        @endif
                    @endif

                @endif
            @endif
                @if(Auth::user()->type==0)

                    <a href="{{route('project.edit',['id'=>$data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;&nbsp;

                    <a href="{{route('project.delete',['id'=>$data->id])}}"><i class="fa fa-times-circle">&nbsp;Delete</i></a>


            @endif
            &nbsp; </span></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">

                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{$data->name}}</a></h2>
                                        <h6 class="d-block"><a href="javascript:void(0)">{{count($data->Project_Partie)}}</a> Parties Involvement</h6>
                                        <h6 class="d-block"><a href="javascript:void(0)">{{count($data->Project_File)}}</a> Files Uploaded</h6>

                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="generalInfo-tab" data-toggle="tab" href="#generalInfo" role="tab" aria-controls="generalInfo" aria-selected="true">General Info</a>
                                        </li>
                                        @if(count($data->Project_Partie)>0)
                                        <li class="nav-item">
                                            <a class="nav-link" id="partiesInfo-tab" data-toggle="tab" href="#partiesInfo" role="tab" aria-controls="partiesInfo" aria-selected="false">Parties Info</a>
                                        </li>
                                        @endif
                                        @if(count($data->Project_File)>0)
                                        <li class="nav-item">
                                            <a class="nav-link" id="fileInfo-tab" data-toggle="tab" href="#fileInfo" role="tab" aria-controls="fileInfo" aria-selected="false">Files Info</a>
                                        </li>
                                        @endif


                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel" aria-labelledby="generalInfo-tab">

                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">File Number</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->file_number}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->name}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Type</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->type}}
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
                                                    {{($data->department_id==null)?($data->created_by!=null)?$data->User->User_Role->Role->group." Created":"N/A":$data->Department->name}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Agreement Type</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->agreement_type}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Starting Date</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->start}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Deadline Date</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->deadline}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Duration</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->agreement_duration." ".$data->duration_type}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Remaining Days</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->remaining_days}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Cost</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <strong>{{'NRs.'.$data->project_cost}}.00</strong>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Annual Maintinance Cost</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <strong>{{'NRs.'.$data->amc}}.00</strong>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Reminder Emails</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <strong>
                                                        @if($data->reminder_email!=null)
                                                        @foreach($data->reminder_email as $rem_email)
                                                            "{{$rem_email}}"&nbsp;
                                                            @endforeach
                                                            @endif
                                                    </strong>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Reminder Email to be Sent before</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->sent_mail_before}} Days of Expiry
                                                </div>
                                            </div>
                                            <hr />


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Status</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{($data->position==1)?'Ongoing':'Completed'}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Project Created By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <a href="{{route('user.detail',['id'=>$data->created_by])}}">{{($data->created_by!=null)?$data->User->name:''}}</a>
                                                </div>
                                            </div>
                                            <hr />

                                        </div>
                                        @if(count($data->Project_Partie)>0)
                                            @php $i=1; @endphp
                                        <div class="tab-pane fade" id="partiesInfo" role="tabpanel" aria-labelledby="partiesInfo-tab">

                                            <table class="table" id="parties_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Authorized Person</th>
                                                    <th>Designation</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->Project_Partie as $partie)
                                                <tr>
                                                    <th scope="row">{{$i++}}</th>
                                                    <td>{{$partie->name}}</td>
                                                    <td>{{$partie->email}}</td>
                                                    <td>{{$partie->contact}}</td>
                                                    <td>{{$partie->contact_person_name}}</td>
                                                    <td>{{$partie->contact_person_designation}}</td>
                                                    <td>{{$partie->contact_person_contact}}</td>
                                                    <td>{{$partie->contact_person_email}}</td>
                                                </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>


                                        </div>
                                        @endif
                                        @if(count($data->Project_File)>0)
                                            @php $j=1; @endphp
                                        <div class="tab-pane fade" id="fileInfo" role="tabpanel" aria-labelledby="fileInfo-tab">


                                            <table class="table" id="file_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>File Name</th>
                                                    <th>File Extension</th>
                                                    <th>File Size</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->Project_File as $file)
                                                    <tr>
                                                        <th scope="row">{{$j++}}</th>
                                                        <td>{{substr($file->file_name,0,30)}}...</td>
                                                        <td>{{$file->file_ext}}</td>
                                                        <td>{{$file->file_size}} Kilo Byte</td>

                                                        <td><a href="{{route('file.download',['id'=>$file->id])}}" target="_blank"><button class="btn btn-success " type="button"><i class="fa fa-download"></i> <span class="bold">Download</span></button></a>
                                                        &nbsp;&nbsp;<a href="{{url('uploads/project_files/'.str_replace(' ','-',$data->Organization->name).'/'.str_replace(' ','-',$data->name).'/'.$file->file_name)}}" target="_blank"><button class="btn btn-success " type="button"><i class="fa fa-file"></i> <span class="bold">View</span></button></a>
                                                        </td>


                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#parties_table').DataTable();
    } );
    $(document).ready(function() {
        $('#file_table').DataTable();
    } );
</script>


@endsection
