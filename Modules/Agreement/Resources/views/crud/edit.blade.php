@extends('user::dashboard.layout.master')
@section('content')
    <script type="text/javascript" src="{{asset('assets/js/multiple-emails.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/multiple-emails.css')}}" />


    <script type="text/javascript">
        $(function() {
            //To render the input device to multiple email input using BootStrap icon
            $('#example_emailBS').multiple_emails({position: "bottom"});
            //OR $('#example_emailBS').multiple_emails("Bootstrap");

            //Shows the value of the input device, which is in JSON format
            $('#current_emailsBS').text($('#example_emailBS').val());
            $('#example_emailBS').change( function(){
                $('#current_emailsBS').text($(this).val());
            });
        });
    </script>
    <div class="container">

        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Edit Project '.$data->name) }}</div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="generalInfo-tab" data-toggle="tab"
                                               href="#generalInfo" role="tab" aria-controls="generalInfo"
                                               aria-selected="true">General Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="fileInfo-tab" data-toggle="tab" href="#fileInfo"
                                               role="tab" aria-controls="fileInfo" aria-selected="false">Files
                                                Info</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel"
                                             aria-labelledby="generalInfo-tab">

                                            <form method="POST" action="{{ route('project.edit',['id'=>$data->id]) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="file_number" class="col-md-4 col-form-label text-md-right">File Number</label>

                                                        <div class="col-md-6">
                                                            <input id="file_number" type="text" placeholder="Enter File Number" class="form-control{{ $errors->has('file_number') ? ' is-invalid' : '' }}" name="file_number" value="{{ $data->file_number }}" required>

                                                            @if ($errors->has('file_number'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_number') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">Company
                                                            Name<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="text" placeholder="Enter Company Name(eg: Shiran Technologies Pvt.Ltd.)" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data->name }}" required>

                                                            @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="type" class="col-md-4 col-form-label text-md-right">Project
                                                            Type<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input list="pgtype" id="type" autocomplete="none" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ $data->type }}">
                                                            <datalist id="pgtype">
                                                                <option value="Mobile Applications">
                                                                <option value="Web Applications">
                                                                <option value="Content Managment System">
                                                                <option value="Web Services">
                                                            </datalist>
                                                            @if ($errors->has('type'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="agtype"
                                                               class="col-md-4 col-form-label text-md-right">Agreement
                                                            Type<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input list="agtype" autocomplete="none" class="form-control{{ $errors->has('agtype') ? ' is-invalid' : '' }}" name="agtype" value="{{ $data->agreement_type }}">
                                                            <datalist id="agtype">
                                                                <option value="Two Party Agreement">
                                                                <option value="Tripartite Agreement">
                                                                <option value="More than 3 Parties">
                                                            </datalist>
                                                            @if ($errors->has('agtype'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agtype') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="start_date"
                                                               class="col-md-4 col-form-label text-md-right">Project
                                                            Start Date<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input id="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ $data->start }}"
                                                                   required>

                                                            @if ($errors->has('start_date'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="end_date"
                                                               class="col-md-4 col-form-label text-md-right">Project
                                                            Deadline Date<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input id="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ $data->deadline }}"
                                                                   required>

                                                            @if ($errors->has('end_date'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ag_duration" class="col-md-4 col-form-label text-md-right">Agreement Duration<span></span></label>

                                                        <div class="col-md-6">
                                                            <input id="ag_duration" type="number" class="form-control{{ $errors->has('ag_duration') ? ' is-invalid' : '' }}" name="ag_duration" value="{{ $data->agreement_duration }}" style="width: 68%;float: left;margin-right: 5px;" placeholder="eg:10 months">
                                                            <select name="duration_type" class="form-control" style="width: 30%">
                                                                <option value="day" {{($data->duration_type=="day")?'selected':''}}>Day</option>
                                                                <option value="month" {{($data->duration_type=="month")?'selected':''}}>Month</option>
                                                                <option value="year" {{($data->duration_type=="year")?'selected':''}}>Year</option>
                                                            </select>

                                                            @if ($errors->has('ag_duration'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ag_duration') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="project_cost" class="col-md-4 col-form-label text-md-right">Project Cost<span></span></label>

                                                        <div class="col-md-6">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">NRs.</div>
                                                                </div>
                                                                <input id="project_cost" type="text" class="form-control{{ $errors->has('project_cost') ? ' is-invalid' : '' }}"  name="project_cost" value="{{ $data->project_cost }}" onkeyup="format(this)" placeholder="Enter Price">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">.00</div>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('project_cost'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('project_cost') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="amc" class="col-md-4 col-form-label text-md-right">Annual Maintenance Cost<span></span></label>

                                                        <div class="col-md-6">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">NRs.</div>
                                                                </div>
                                                                <input id="amc" type="text" class="form-control{{ $errors->has('amc') ? ' is-invalid' : '' }}"  name="amc" value="{{ $data->amc }}" onkeyup="format(this)" placeholder="Enter Price">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">.00</div>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('amc'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amc') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="ag_duration" class="col-md-4 col-form-label text-md-right">Reminder Email Address<span></span></label>

                                                        <div class="col-md-6">

                                                            <input type='text' id='example_emailBS' autocomplete="none" placeholder="Enter Multiple Email and Tab" name='example_emailBS' class='form-control' value='{{ $data->reminder_email }}' required>
                                                            <small>For Multiple email entry please enter email and press space bar</small><br>
                                                            <small style="color: red">Please enter Email address for reminder email before agreement expiry</small>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="send_mail" class="col-md-4 col-form-label text-md-right">Send Reminder Email Before<span></span></label>

                                                        <div class="col-md-6">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Days</div>
                                                                </div>
                                                                <input id="send_mail" type="number" class="form-control{{ $errors->has('send_mail') ? ' is-invalid' : '' }}"  name="send_mail" value="{{ $data->sent_mail_before }}"  placeholder="Enter Day to send Reminder Email before expiry">

                                                            </div>
                                                            @if ($errors->has('send_mail'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('send_mail') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="image"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Parties Involved') }}</label>

                                                        <div class="col-md-6">

                                                            <div class="field_wrapper">
                                                                <div>
                                                                    @php $i=0;
                                                                    $party=[
                                                                        '0'=>'First',
                                                                        '1'=>'Second',
                                                                        '2'=>'Third',
                                                                        '3'=>'Fourth',
                                                                        '4'=>'Fifth',
                                                                        '5'=>'Sixth',
                                                                        '6'=>'Seventh',
                                                                        '7'=>'Eighth',
                                                                        '8'=>'Ninth',
                                                                        '9'=>'Tenth'
                                                                        ];
                                                                    @endphp
                                                                    @if(count($data->Project_Partie)>0)
                                                                        <a href="javascript:void(0);" class="add_button"
                                                                           title="Add field" style="position: absolute;
                                             margin: 7px 0px 0px 350px;"><img src="{{url('assets/img/add.png')}}"
                                                                              height="20"/></a>
                                                                        @foreach($data->Project_Partie as $projectClient)
                                                                            <fieldset class="border p-2">
                                                                                <legend class="w-auto">{{$party[$i]}} Party Information
                                                                                </legend>
                                                                                <input type="text"
                                                                                       name="party[{{$i}}][name]"
                                                                                       value="{{$projectClient->name}}"
                                                                                       class="form-control"
                                                                                       placeholder="Enter Name"/><br>
                                                                                <input type="email"
                                                                                       name="party[{{$i}}][email]"
                                                                                       value="{{$projectClient->email}}"
                                                                                       class="form-control"
                                                                                       placeholder="Enter Email Address"/><br>
                                                                                <input type="text"
                                                                                       name="party[{{$i}}][contact]"
                                                                                       value="{{$projectClient->contact}}"
                                                                                       class="form-control"
                                                                                       placeholder="Enter Contact"/><br>
                                                                                <input type="text" name="party[{{$i}}][contact_person_name]" value="{{$projectClient->contact_person_name}}" class="form-control {{ $errors->has('party.'.$i.'.contact_person_name') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Name"/><br>
                                                                                <input type="text" name="party[{{$i}}][contact_person_designation]" value="{{$projectClient->contact_person_designation}}" class="form-control {{ $errors->has('party.'.$i.'.contact_person_designation') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Designation"/><br>
                                                                                <input type="text" name="party[{{$i}}][contact_person_contact]" value="{{$projectClient->contact_person_contact}}" class="form-control {{ $errors->has('party.'.$i.'.contact_person_contact') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Phone"/><br>
                                                                                <input type="text" name="party[{{$i}}][contact_person_email]" value="{{$projectClient->contact_person_email}}" class="form-control {{ $errors->has('party.'.$i.'.contact_person_email') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Email"/>

                                                                            </fieldset>
                                                                            <a href="{{route('project.client.remove',['id'=>$projectClient->id])}}"
                                                                               style="position:absolute;margin:-100px 0px 0px 500px;">
                                                                                <img
                                                                                    src="{{url('assets/img/remove.png')}}"
                                                                                    height="20"/></a>
                                                                            @php $i++ @endphp
                                                                        @endforeach

                                                                    @else
                                                                        <p>0 Parties Involvement Click + to add</p>
                                                                        <a href="javascript:void(0);" class="add_button"
                                                                           title="Add field" style="position: absolute;
                                             margin: -40px 0px 0px 350px;"><img src="{{url('assets/img/add.png')}}"
                                                                                height="20"/></a>
                                                                    @endif

                                                                </div>
                                                            </div>


                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
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

                                        @php $j=1 @endphp
                                        <div class="tab-pane fade" id="fileInfo" role="tabpanel"
                                             aria-labelledby="fileInfo-tab">

                                            <form method="POST" action="{{ route('file.upload',['id'=>$data->id]) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <fieldset class="border p-2">
                                                    <legend class="w-auto">Add More Files to {{$data->name}}Project
                                                    </legend>
                                                    <div class="form-group">
                                                        <input name="file[]" id="poster" type="file" multiple>

                                                        <input type="submit" value="Submit" class="btn btn-success"><br>
                                                        <small>Each File Size must be less than or equal to 500KB</small>
                                                    </div>
                                                </fieldset>
                                            </form>

                                            @if(count($data->Project_File)>0)

                                                <table class="table table-responsive" id="file_table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">File Extension</th>
                                                        <th scope="col">File Size</th>
                                                        <th scope="col">Download</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data->Project_File as $file)
                                                        <tr>
                                                            <th scope="row">{{$j++}}</th>
                                                            <td>{{$file->file_name}}</td>
                                                            <td>{{$file->file_ext}}</td>
                                                            <td>{{$file->file_size}} Kilo Byte</td>

                                                            <td><a href="{{route('file.download',['id'=>$file->id])}}" target="_blank"><button class="btn btn-success " type="button"><i class="fa fa-download"></i> <span class="bold">Download</span></button></a>
                                                            </td>
                                                            <td><a href="{{route('file.delete',['id'=>$file->id])}}"><button class="btn btn-success " type="button"><i class="fa fa-trash"></i> <span class="bold">Delete</span></button>
                                                                    </a></td>


                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            @else
                                                <p>No Files Found ! Upload Files</p>
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
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            var maxField = 20; //Input fields increment limitation
            var x = <?=$i+1?>;
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper


            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                if (x < maxField) {

                    var fieldHTML = '<div style="margin-top:5px"><fieldset class="border p-2">' +
                        '<legend  class="w-auto">'+inWords(x)+' Party Information </legend>' +
                        '<input type="text" class="form-control" name="party['+x+'][name]" value="" placeholder="Enter '+inWords(x)+'Party Name"/><br>' +
                        '<input type="text" class="form-control" name="party['+x+'][email]" value="" placeholder="Enter '+inWords(x)+'Party Email"/><br>'+
                        '<input type="text" class="form-control" name="party['+x+'][contact]" value="" placeholder="Enter '+inWords(x)+'Party Contact"/><br>' +
                        '<input type="text" name="party['+x+'][contact_person_name]" value="" class="form-control" placeholder="Enter Contact Person Name"/><br>'+
                        '<input type="text" name="party['+x+'][contact_person_designation]" value="" class="form-control" placeholder="Enter Contact Person Designation"/><br>'+
                        '<input type="text" name="party['+x+'][contact_person_contact]" value="" class="form-control" placeholder="Enter Contact Person Phone"/><br>'+
                        '<input type="text" name="party['+x+'][contact_person_email]" value="" class="form-control" placeholder="Enter Contact Person Email"/>'+
                        '</fieldset>'+
                        '<a href="javascript:void(0);" class="remove_button" style="position: absolute;margin: -215px 0px 0px 500px;">' +
                        '<img src="{{url('assets/img/remove.png')}}" height="20"/></a></div>'; //New input field html

                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        var a = ['','First ','Second ','Third ','Fourth ', 'Fifth ','Sixth ','Seventh ','Eighth ','Ninth ','Tenth ','Eleventh ','Twelfth ','Thirteenth ','Fourteenth ','Fifteenth ','Sixteenth ','Seventeenth ','Eighteenth ','Nineteenth '];
        var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

        function inWords (num) {
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]])  : '';
            return str;
        }
        function format(input) {
            var nStr = input.value + '';
            nStr = nStr.replace(/\,/g, "");
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            input.value = x1 + x2;

        }


        $(document).ready(function() {
            $('#file_table').DataTable();
        } );
    </script>

@endsection



