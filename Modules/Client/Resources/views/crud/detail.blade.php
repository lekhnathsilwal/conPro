@extends('user::dashboard.layout.master')
@section('content')
    <div class="container">

        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Client Detail of '.$data->company) }}<span style="float: right">
                @if(count($permission)>0)
                        @if(array_key_exists('Client',$permission[0]['module']))
                                @if($permission[0]['module']['Client']['edit']==1 || $data->created_by==Auth::id())

                                    <a href="{{route('client.edit',['id'=>$data->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&nbsp;

                                @endif


                                @if($permission[0]['module']['Client']['delete']==1 || $data->created_by==Auth::id())

                                    <a href="javascript:void(0)" onclick="del({{$data->id}})"><i class="fa fa-times-circle">&nbsp;Delete</i></a>

                                @endif
                            @endif
                    @endif
                    @if(Auth::user()->type==0)

                        <a href="javascript:void(0)" onclick="del({{$data->id}})"><i class="fa fa-times-circle">&nbsp;Delete</i></a>


                    @endif
            &nbsp; </span></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">

                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{$data->company}}</a></h2>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="generalInfo-tab" data-toggle="tab" href="#generalInfo" role="tab" aria-controls="generalInfo" aria-selected="true">General Info</a>
                                        </li>
                                        @if(count($data->clientDetail)>0)
                                            <li class="nav-item">
                                                <a class="nav-link" id="partiesInfo-tab" data-toggle="tab" href="#partiesInfo" role="tab" aria-controls="partiesInfo" aria-selected="false">Contact Persons Info</a>
                                            </li>
                                        @endif


                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel" aria-labelledby="generalInfo-tab">

                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Client Email</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->email}}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">

                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Client Location</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->location}}
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Client Phone</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$data->contact}}
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


                                        </div>
                                        @if(count($data->clientDetail)>0)
                                            @php $i=1; @endphp
                                            <div class="tab-pane fade" id="partiesInfo" role="tabpanel" aria-labelledby="partiesInfo-tab">

                                                <table class="table" id="parties_table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Contact Person</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Designation</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data->clientDetail as $detail)
                                                        <tr>
                                                            <th scope="row">{{$i++}}</th>
                                                            <td>{{$detail->authorized_person}}</td>
                                                            <td>{{$detail->email}}</td>
                                                            <td>{{$detail->contact}}</td>
                                                            <td>{{$detail->designation}}</td>
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
        function del(id)
        {
            if(window.confirm('Are you sure to delete client ?'))
            {
                window.location.href="{{url('client')}}/delete/"+id;
            }
        }
    </script>


@endsection
