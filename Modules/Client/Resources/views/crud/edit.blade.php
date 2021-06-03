@extends('user::dashboard.layout.master')
@section('content')

    <div class="container">

        <div class="card">
            @include('common.flash')

            <div class="card-header">{{ __('Edit Client '.$data->company) }}</div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    <div class="tab-content ml-1" id="myTabContent">

                                        <div class="tab-pane fade show active" id="generalInfo" role="tabpanel"
                                             aria-labelledby="generalInfo-tab">

                                            <form method="POST" action="{{ route('client.edit',['id'=>$data->id]) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">Company Name<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input type="text" placeholder="Enter Company Name(eg: Shiran Technologies Pvt.Ltd.)" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $data->company }}" required autofocus>

                                                            @if ($errors->has('company'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                                                        <div class="col-md-6">
                                                            <textarea id="location" placeholder="Enter Client Contact Address" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" required>{{ $data->location }}</textarea>

                                                            @if ($errors->has('location'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email Address<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" placeholder="eg: example@example.com" >

                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="contact" class="col-md-4 col-form-label text-md-right">Contact Number<span>*</span></label>

                                                        <div class="col-md-6">
                                                            <input class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ $data->contact }}" placeholder="eg:01-4-000000,9851000000">
                                                            @if ($errors->has('contact'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="image"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Contact Person Info') }}</label>

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
                                                                    @if($data->clientDetail)
                                                                        <a href="javascript:void(0);" class="add_button"
                                                                           title="Add field" style="position: absolute;
                                             margin: 7px 0px 0px 400px;"><img src="{{url('assets/img/add.png')}}"
                                                                              height="20"/></a>
                                                                        @foreach($data->clientDetail as $infoClient)

                                                                            <fieldset class="border p-2">
                                                                                <legend  class="w-auto">{{$party[$i]}} Contact Person Information</legend>
                                                                                <input type="text" name="party[{{$i}}][name]" value="{{$infoClient->authorized_person}}" class="form-control {{ $errors->has('party.'.$i.'.name') ? ' is-invalid' : '' }}" placeholder="Enter {{$party[$i]}} Contact Person name"  required/><br>
                                                                                <input type="email" name="party[{{$i}}][email]" value="{{$infoClient->email}}" class="form-control {{ $errors->has('party.'.$i.'.email') ? ' is-invalid' : '' }}" placeholder="Enter {{$party[$i]}} Contact Person Email" required/><br>
                                                                                <input type="text" name="party[{{$i}}][contact]" value="{{$infoClient->contact}}" class="form-control {{ $errors->has('party.'.$i.'.contact') ? ' is-invalid' : '' }}" placeholder="Enter {{$party[$i]}} Contact Person Phone" required/><br>
                                                                                <input type="text" name="party[{{$i}}][designation]" value="{{$infoClient->designation}}" class="form-control {{ $errors->has('party.'.$i.'.designation') ? ' is-invalid' : '' }}" placeholder="Enter {{$party[$i]}} Contact Person Designation" required/><br>
                                                                            </fieldset>
                                                                            <a href="{{route('client.detail.remove',['id'=>$infoClient->id])}}"
                                                                               style="position:absolute;margin:-100px 0px 0px 500px;">
                                                                                <img
                                                                                    src="{{url('assets/img/remove.png')}}"
                                                                                    height="20"/></a>
                                                                            @php $i++ @endphp
                                                                        @endforeach

                                                                    @else
                                                                        <p>0 Contact Contact Person Click + to add</p>
                                                                        <a href="javascript:void(0);" class="add_button"
                                                                           title="Add field" style="position: absolute;
                                             margin: -40px 0px 0px 350px;"><img src="{{url('assets/img/add.png')}}"
                                                                                height="20"/></a>
                                                                    @endif

                                                                </div>
                                                            </div>
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

                                            @if($data->Project_File)

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
                        '<legend  class="w-auto">'+inWords(x)+' Contact Person Information </legend>' +
                        '<input type="text" class="form-control" name="party['+x+'][name]" value="" placeholder="Enter '+inWords(x)+'Contact Person Name"/><br>' +
                        '<input type="email" class="form-control" name="party['+x+'][email]" value="" placeholder="Enter '+inWords(x)+'Contact Person Email"/><br>'+
                        '<input type="number" class="form-control" name="party['+x+'][contact]" value="" placeholder="Enter '+inWords(x)+'Contact Person Phone"/><br>' +
                        '<input type="text" name="party['+x+'][designation]" value="" class="form-control" placeholder="Enter '+inWords(x)+'Contact Person Designation"/><br>'+
                        '</fieldset>'+
                        '<a href="javascript:void(0);" class="remove_button" style="position:absolute;margin:-215px 0px 0px 500px;">' +
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



