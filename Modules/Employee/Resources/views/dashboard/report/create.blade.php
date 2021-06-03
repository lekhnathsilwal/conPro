@extends('employee::dashboard.layout.master')
@section('content')

    @if(old("task_type"))
    <script>
        $(window).load(function(){
            setData("{{old("task_type")}}");
            getClientDetail({{old('client')}});
        });
    </script>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Add Daily Report') }}</div>
                    <form method="POST" action="{{ route('report.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="task_type" class="col-md-4 col-form-label text-md-right">Task Type<span>*</span></label>

                                <div class="col-md-6">
                                    <select name="task_type" class="form-control{{ $errors->has('task_type') ? ' is-invalid' : '' }}" onchange="setData(this.value)">

                                        <option value="">Choose Report Type</option>
                                        <option value="meeting" {{old('task_type')=="meeting"?"selected":""}}>Meeting</option>
                                        <option value="call" {{old('task_type')=="call"?"selected":""}}>Telephonic Conversation</option>
                                        <option value="doc" {{old('task_type')=="doc"?"selected":""}}>Documentation</option>
                                        <option value="operation" {{old('task_type')=="operation"?"selected":""}}>Operation</option>
                                        <option value="other" {{old('task_type')=="other"?"selected":""}}>Other</option>
                                    </select>

                                    @if ($errors->has('task_type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('task_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="client" class="col-md-4 col-form-label text-md-right">Client<span>*</span></label>

                                <div class="col-md-6">
                                    <select name="client" id="client" class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }} select2" onchange="getClientDetail(this.value)">

                                        <option value="">Choose Client</option>
                                        @foreach($client as $clientData)
                                            <option value="{{$clientData->id}}" {{ (old('client')==$clientData->id?"selected":"") }}>{{$clientData->company}}</option>
                                        @endforeach
                                        <option value="0">Other</option>
                                    </select>


                                    @if ($errors->has('client'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div id="loader" style="text-align: center"><img src="{{asset('assets/img/image-loading.gif')}}" class="icon-2x" id="icon" /></div>

                            <div id="type-meeting">
                            <div class="form-group row">
                                <label for="venue" class="col-md-4 col-form-label text-md-right">Venue<span>*</span></label>

                                <div class="col-md-6">
                                    <input type="text" name="venue" autocomplete="off" list="venue_list" value="{{old('venue')}}" id="venue" class="form-control{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="Choose Venue or Enter Venue"/>
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

                            <div id="type-call">

                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Call Status<span></span></label>

                                    <div class="col-md-6">
                                        <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">

                                            <option value="called" {{(old('status')=="called")?'selected':''}}>Called</option>
                                            <option value="received" {{(old('status')=="received")?'selected':''}}>Received</option>

                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div id="type-operation">
                                <div class="form-group row" id="type-meeting">
                                    <label for="operation_type" class="col-md-4 col-form-label text-md-right">Operation Type<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" name="operation_type" list="operation_list" class="form-control{{ $errors->has('operation_type') ? ' is-invalid' : '' }}" placeholder="Select or Enter Operation type(eg:Development)"/>
                                        <datalist id="operation_list">
                                            <option>Data Entry</option>
                                            <option>Account Work</option>
                                            <option>Mechanical Works</option>
                                            <option>Marketing</option>
                                            <option>Human Resource</option>
                                            <option>Field Visit</option>
                                            <option>Purchased/Sent Parts</option>
                                            <option>Tender Purchase</option>
                                            <option>Tender Bid</option>
                                            <option>Bank Visit</option>
                                            <option>Party Visit</option>
                                            
                                        </datalist>


                                        @if ($errors->has('operation_type'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('operation_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div id="type-doc">
                                <div class="form-group row">
                                    <label for="doc_type" class="col-md-4 col-form-label text-md-right">Documentation Type<span>*</span></label>

                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" name="doc_type" list="document_list" class="form-control{{ $errors->has('doc_type') ? ' is-invalid' : '' }}" placeholder="Select or Enter Document type(eg:Agreement)"/>
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

                            <div id="type-other">
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

                            <div class="form-group row">
                                <label for="with" class="col-md-4 col-form-label text-md-right">With(Person Name)</label>

                                <div class="col-md-6">
                                    <input type="text" list="with" name="authorizedPerson" id="withPerson" autocomplete="off" placeholder="Select Authorized Person for Client or Enter Name" value="{{old('authorizedPerson')}}"  class="form-control{{ $errors->has('authorizedPerson') ? ' is-invalid' : '' }}">
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
                                    <input type="datetime-local" name="taskDateTime" value="{{old('taskDateTime')}}" class="form-control{{ $errors->has('taskDateTime') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('taskDateTime'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('taskDateTime') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col-md-4 col-form-label text-md-right">Duration<span>*</span></label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">H:</div>
                                        <input type="number" name="timeDurationHour" placeholder="Hour" value="{{old('timeDurationHour')}}" class="form-control{{ $errors->has('timeDurationHour') ? ' is-invalid' : '' }}" style="width: 40%"/>

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">M:</div>
                                            <input type="number" name="timeDurationMinute" placeholder="Minute" value="{{old('timeDurationHour')}}" class="form-control {{ $errors->has('timeDurationHour') ? ' is-invalid' : '' }}"/>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="conclusion" class="col-md-4 col-form-label text-md-right">Conclusion<span></span></label>

                                <div class="col-md-6">
                                    <textarea name="conclusion" class="form-control{{ $errors->has('conclusion') ? ' is-invalid' : '' }}" rows="10" placeholder="Enter overall conclusion...">{{old('conclusion')}}</textarea>

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
                                        {{ __('Register') }}
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

        $("#type-meeting").hide();
        $("#type-call").hide();
        $("#type-doc").hide();
        $("#type-operation").hide();
        $("#type-other").hide();
        $("#loader").hide();

        function getClientDetail(id) {
            if(id!=0) {
                var client_id = id;
                var url = '{{ url('client/detail') }}' + '/' + client_id;
                $("#loader").show();
                jQuery("#venue").focus(function () {
                    $(this).val("");
                });
                jQuery("#withPerson").focus(function () {
                    $(this).val("");
                })
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
                        $("#with").empty();
                        $("#venue_list").empty();
                        var res = JSON.stringify(result.data);
                        var data = JSON.parse(res);
                        $("#venue_list").append($("<option>").attr('value', data.location).text("Client Venue"));
                        var client_detail = data.client_detail;
                        if (client_detail.length > 0) {
                            for (var i = 0; i < client_detail.length; i++) {
                                console.log(client_detail[i]["authorized_person"]);
                                $("#with").append($("<option>").attr('value', client_detail[i]["authorized_person"]));
                            }
                        } else {
                            $("#with").append($("<option>").attr('value', null).text("No Record Found"));
                        }
                    }
                });
            }
        }

        function setData(value) {
            if(value=='')
            {
                $("#type-meeting").hide();
                $("#type-call").hide();
                $("#type-doc").hide();
                $("#type-operation").hide();
                $("#type-other").hide();
            }
            else{
                if(value=="meeting")
                {
                    $("#type-meeting").show();
                    $("#type-call").hide();
                    $("#type-doc").hide();
                    $("#type-operation").hide();
                    $("#type-other").hide();
                }
                if(value=="call")
                {
                    $("#type-meeting").hide();
                    $("#type-call").show();
                    $("#type-doc").hide();
                    $("#type-operation").hide();
                    $("#type-other").hide();
                }
                if(value=="doc")
                {
                    $("#type-meeting").hide();
                    $("#type-call").hide();
                    $("#type-doc").show();
                    $("#type-operation").hide();
                    $("#type-other").hide();
                }
                if(value=="operation")
                {
                    $("#type-meeting").hide();
                    $("#type-call").hide();
                    $("#type-doc").hide();
                    $("#type-operation").show();
                    $("#type-other").hide();
                }
                if(value=="other")
                {
                    $("#type-meeting").hide();
                    $("#type-call").hide();
                    $("#type-doc").hide();
                    $("#type-operation").hide();
                    $("#type-other").show();
                }


            }
        }

    </script>
@endsection
