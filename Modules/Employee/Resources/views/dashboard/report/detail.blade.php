@extends('employee::dashboard.layout.master')
@section('content')
    <div class="container">

        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Daily Report Detail of '.$data->created_at) }}<span style="float: right">
                    <a href="{{route('report.edit',['id'=>$data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="del({{$data->id}});"><i class="fa fa-trash">&nbsp;Delete</i></a>
                </span>
                </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel" aria-labelledby="generalInfo-tab">

                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Report Date Time</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data_value->date_time}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Task Nature</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{strtoupper($data->dailyTask->task_nature)}}
                                                </div>
                                            </div>
                                            <hr />

                                            @if($data->dailyTask->task_nature=="meeting")
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Venue</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data_value->venue}}
                                                </div>
                                            </div>
                                            <hr />
                                            @endif
                                            @if($data->dailyTask->task_nature=="call")
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-weight:bold;">Call Status</label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        {{strtoupper($data_value->call_status)}}
                                                    </div>
                                                </div>
                                                <hr />
                                            @endif
                                            @if($data->dailyTask->task_nature=="doc" || $data->dailyTask->task_nature=="operation")
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-weight:bold;">
                                                            {{($data->dailyTask->task_nature=="doc")?'Document Type':'Operation Type'}}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        {{strtoupper($data_value->task)}}
                                                    </div>
                                                </div>
                                                <hr />
                                            @endif
                                            @if($data->dailyTask->task_nature=="other")
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-weight:bold;">
                                                            Task Title
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        {{strtoupper($data_value->task)}}
                                                    </div>
                                                </div>
                                                <hr />
                                            @endif
                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Client Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data_value->client_name}}
                                                </div>
                                            </div>
                                            <hr />

                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-weight:bold;">
                                                        {{($data->dailyTask->task_nature=="meeting")?'Meeting With':($data->dailyTask->task_nature=="call")?'Talked With':"Authorized for Task"}}
                                                            <br><small>Authorized Person for Client</small>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        {{($data_value->authorizedPerson!=null)?$data_value->authorizedPerson:"N/A"}}
                                                    </div>
                                                </div>
                                                <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;"> Task Duration</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    @php
                                                    $duration=explode(":",$data_value->duration);
                                                    @endphp
                                                    {{$duration[0]." Hour"." ".$duration[1]." Minutes "}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Conclusion</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data_value->task_conclusion}}
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
    <script>
        function del(id)
        {
            if(window.confirm("Are you sure to delete report ?"))
            {
                window.location.href="{{url('report')}}/delete/"+id;
            }
        }
    </script>
@endsection
