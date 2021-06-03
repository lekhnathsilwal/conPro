@extends('employee::dashboard.layout.master')
@section('content')

{{--    {{dd($data_value)}}--}}

        <script>
            $(window).load(function(){
                getClientDetail("{{$data_value->client_id}}");
            });
        </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Edit Report') }}</div>
                    <form method="POST" action="{{ route('report.edit',['id'=>$data->id]) }}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="client" class="col-md-4 col-form-label text-md-right">Client<span>*</span></label>

                                <div class="col-md-6">
                                    <select name="client" class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }} select2" onchange="getClientDetail(this.value)">

                                        <option value="">Choose Client</option>
                                        @foreach($client as $clientData)
                                            <option value="{{$clientData->id}}" {{ ($data->client_id==$clientData->id?"selected":"") }}>{{$clientData->company}}</option>
                                        @endforeach
                                        <option value="0" {{($data->client_id==0)?"Selected":""}}>Other</option>
                                    </select>

                                    @if ($errors->has('client'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="module_value" value="{{$data_value->id}}"/>
                            @if($data_value->module=="meeting")
                            <div id="type-meeting">
                                <input type="hidden" name="module" value="meeting"/>
                                <div class="form-group row">
                                    <label for="venue" class="col-md-4 col-form-label text-md-right">Venue<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" name="venue" autocomplete="off" list="venue_list" value="{{$data_value->venue}}" id="venue" class="form-control{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="Choose Venue or Enter Venue"/>
                                        <datalist id="venue_list">
                                        </datalist>
                                        @if ($errors->has('venue'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @elseif($data_value->module=="call")
                            <div id="type-call">
                                <input type="hidden" name="module" value="call"/>
                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Call Status<span></span></label>

                                    <div class="col-md-6">
                                        <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">

                                            <option value="called" {{($data_value->call_status=="called")?'selected':''}}>Called</option>
                                            <option value="received" {{($data_value->call_status=="received")?'selected':''}}>Received</option>

                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @elseif($data_value->module=="operation")
                            <div id="type-operation">
                                <input type="hidden" name="module" value="operation"/>
                                <div class="form-group row">
                                    <label for="operation_type" class="col-md-4 col-form-label text-md-right">Operation Type<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" name="operation_type" value="{{$data_value->task}}" list="operation_list" class="form-control{{ $errors->has('operation_type') ? ' is-invalid' : '' }}" placeholder="Select or Enter Operation type(eg:Development)"/>
                                        <datalist id="operation_list">
                                            <option>Research and Development</option>
                                            <option>Manufacturing</option>
                                            <option>Marketing</option>
                                            <option>Human Resource</option>
                                            <option>Development</option>
                                        </datalist>
                                        @if ($errors->has('operation_type'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('operation_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @elseif($data_value->module=="doc")
                            <div id="type-doc">
                                <input type="hidden" name="module" value="doc"/>
                                <div class="form-group row">
                                    <label for="doc_type" class="col-md-4 col-form-label text-md-right">Documentation Type<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" value="{{$data_value->task}}" name="doc_type" list="document_list" class="form-control{{ $errors->has('doc_type') ? ' is-invalid' : '' }}" placeholder="Select or Enter Document type(eg:Agreement)"/>
                                        <datalist id="document_list">
                                            <option>Agreement</option>
                                            <option>Product Related</option>
                                            <option>Company Profile</option>
                                            <option>Project Related</option>
                                            <option>Financial</option>
                                        </datalist>
                                        @if ($errors->has('doc_type'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doc_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @elseif($data_value->module=="other")
                            <div id="type-other">
                                <input type="hidden" name="module" value="other"/>
                                <div class="form-group row" id="type-meeting">
                                    <label for="task_title" class="col-md-4 col-form-label text-md-right">Task title<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" name="task_title" class="form-control{{ $errors->has('task_title') ? ' is-invalid' : '' }}" placeholder="Enter specific task title" value="{{old('task_title')}}"/>

                                        @if ($errors->has('task_title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('task_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div id="loader" style="text-align: center"><img src="{{asset('assets/img/image-loading.gif')}}" class="icon-2x" id="icon" /></div>

                            <div class="form-group row">
                                <label for="with" class="col-md-4 col-form-label text-md-right">Authorized Person<span>*</span></label>

                                <div class="col-md-6">
                                    <input type="text" list="with" name="authorizedPerson" id="withPerson" autocomplete="off" placeholder="Select Authorized Person for Client or Enter Name" value="{{($data_value->authorizedPerson!="")?$data_value->authorizedPerson:""}}"  class="form-control{{ $errors->has('authorizedPerson') ? ' is-invalid' : '' }}">
                                    <datalist id="with">
                                    </datalist>

                                    @if ($errors->has('authorizedPerson'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('authorizedPerson') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="taskDateTime" class="col-md-4 col-form-label text-md-right">Date and Time<span>*</span></label>
                                <div class="col-md-6">
                                    <input type="datetime-local" value="{{str_replace(" ","T",$data_value->date_time)}}" name="taskDateTime" class="form-control{{ $errors->has('taskDateTime') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('taskDateTime'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('taskDateTime') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col-md-4 col-form-label text-md-right">Duration<span>*</span></label>
                                @php
                                $duration=explode(':',$data_value->duration);
                                @endphp
                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">H:</div>
                                        <input type="number" name="timeDurationHour" placeholder="Hour" value="{{$duration[0]}}" class="form-control{{ $errors->has('timeDurationHour') ? ' is-invalid' : '' }}" style="width: 40%"/>

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">M:</div>
                                            <input type="number" name="timeDurationMinute" placeholder="Minute" value="{{$duration[1]}}" class="form-control {{ $errors->has('timeDurationMinute') ? ' is-invalid' : '' }}"/>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="conclusion" class="col-md-4 col-form-label text-md-right">Conclusion<span></span></label>

                                <div class="col-md-6">
                                    <textarea name="conclusion" class="form-control{{ $errors->has('conclusion') ? ' is-invalid' : '' }}" rows="10" placeholder="Enter overall conclusion...">{{$data_value->task_conclusion}}</textarea>

                                    @if ($errors->has('conclusion'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('conclusion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
         $("#loader").hide();
        function getClientDetail(id) {
            if(!id)
            {
                alert('Please Choose Client! Null value given');
                return;
            }
            if(id!=0) {
                var client_id = id;
                var url = '{{ url('client/detail') }}' + '/' + client_id;
                $("#loader").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: url,
                    method: 'get',
                    success: function (result) {
                        $("#loader").hide();
                        var res = JSON.stringify(result.data);
                        var data = JSON.parse(res);
                        @if($data_value->module=='meeting')
                        getClientDetailVenue(data);
                        @endif
                        getClientDetailAuthorizedPerson(data);
                    }
                });
            }
        }

        function getClientDetailAuthorizedPerson(data) {
            jQuery("#withPerson").focus(function () {
                $(this).val("");
            })
            $("#with").empty();
            var client_detail=data.client_detail;
            if(client_detail.length>0)
            {
                for(var i=0;i<client_detail.length;i++)
                {
                    console.log(client_detail[i]["authorized_person"]);
                    $("#with").append($("<option>").attr('value',client_detail[i]["authorized_person"]));
                }
            }
            else
            {
                $("#with").append($("<option>").attr('value',null).text("No Record Found"));
            }
        }

        function getClientDetailVenue(data){

            jQuery("#venue").focus(function () {
                $(this).val("");
            });
            $("#venue_list").empty();
            $("#venue_list").append($("<option>").attr('value', data.location).text("Client Venue"));
        }
    </script>
@endsection
