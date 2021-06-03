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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Add New Project') }}</div>
                    <form method="POST" action="{{ route('project.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Company Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" list="company_list" autocomplete="none" type="text" placeholder="Enter Company Name(eg: Shiran Technologies Pvt.Ltd.)" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    <datalist id="company_list">
                                        @if(count($company_list)>0)
                                            @foreach($company_list as $company)
                                        <option value="{{$company->name}}">
                                            @endforeach
                                        @endif
                                    </datalist>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="file_number" class="col-md-4 col-form-label text-md-right">File Number<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="file_number" autocomplete="none" type="text" placeholder="Enter File Number" class="form-control{{ $errors->has('file_number') ? ' is-invalid' : '' }}" name="file_number" value="{{ old('file_number') }}" required autofocus>

                                    @if ($errors->has('file_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Project Type<span>*</span></label>

                                <div class="col-md-6">
                                    <input list="pgtype" id="type" autocomplete="none" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" placeholder="eg: Mobile Application" >
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
                                <label for="agtype" class="col-md-4 col-form-label text-md-right">Agreement Type<span>*</span></label>

                                <div class="col-md-6">
                                    <input list="agtype" autocomplete="none" class="form-control{{ $errors->has('agtype') ? ' is-invalid' : '' }}" name="agtype" value="{{ old('agtype') }}" placeholder="eg:Two Party agreement">

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
                                <label for="start_date" class="col-md-4 col-form-label text-md-right">Agreement Signed Date<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>

                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="end_date" class="col-md-4 col-form-label text-md-right">Agreement Expiry Date<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}">

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
                                    <input id="ag_duration" type="number" class="form-control{{ $errors->has('ag_duration') ? ' is-invalid' : '' }}" name="ag_duration" value="{{ old('ag_duration') }}" style="width: 68%;float: left;margin-right: 5px;" placeholder="eg:10 months">
                                    <select name="duration_type" class="form-control" style="width: 30%"><option value="day">Day</option><option value="month">Month</option><option value="year">Year</option></select>

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
                                    <input id="project_cost" type="text" class="form-control{{ $errors->has('project_cost') ? ' is-invalid' : '' }}"  name="project_cost" value="{{ old('project_cost') }}" onkeyup="format(this)" placeholder="Enter Price">
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
                                        <input id="amc" type="text" class="form-control{{ $errors->has('amc') ? ' is-invalid' : '' }}"  name="amc" value="{{ old('amc') }}" onkeyup="format(this)" placeholder="Enter Price">
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

                            <input type='text' id='example_emailBS' placeholder="Enter Multiple Email and Tab" name='example_emailBS' class='form-control' value='{{ old('example_emailBS') }}' required>
                                    <small>For Multiple email entry please enter email and press space bar</small>
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
                                        <input id="send_mail" type="number" class="form-control{{ $errors->has('send_mail') ? ' is-invalid' : '' }}"  name="send_mail" value="{{ old('send_mail') }}"  placeholder="Enter Day to send Reminder Email before expiry">

                                    </div>
                                    @if ($errors->has('send_mail'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('send_mail') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Parties Involved') }}</label>

                                <div class="col-md-6">

                                    <div class="field_wrapper">
                                        <div>
                                            <fieldset class="border p-2">
                                                <legend  class="w-auto">First Party Information</legend>
                                            <input type="text" name="party[0][name]" value="{{old('party.0.name')}}" class="form-control {{ $errors->has('party.0.name') ? ' is-invalid' : '' }}" placeholder="Enter First Party name"  required/><br>
                                            <input type="email" name="party[0][email]" value="{{old('party.0.email')}}" class="form-control {{ $errors->has('party.0.email') ? ' is-invalid' : '' }}" placeholder="Enter First Party Email" required/><br>
                                            <input type="number" name="party[0][contact]" value="{{old('party.0.contact')}}" class="form-control {{ $errors->has('party.0.contact') ? ' is-invalid' : '' }}" placeholder="Enter First Party Contact" required/><br>
                                            <input type="text" name="party[0][contact_person_name]" value="{{old('party.0.contact_person_name')}}" class="form-control {{ $errors->has('party.0.contact_person_name') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Name" required/><br>
                                            <input type="text" name="party[0][contact_person_designation]" value="{{old('party.0.contact_person_designation')}}" class="form-control {{ $errors->has('party.0.contact_person_designation') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Designation" required/><br>
                                            <input type="number" name="party[0][contact_person_contact]" value="{{old('party.0.contact_person_contact')}}" class="form-control {{ $errors->has('party.0.contact_person_contact') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Phone" required/><br>
                                            <input type="email" name="party[0][contact_person_email]" value="{{old('party.0.contact_person_email')}}" class="form-control {{ $errors->has('party.0.contact_person_email') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Email" required/>


                                            </fieldset>
                                            <fieldset class="border p-2">
                                                <legend  class="w-auto">Second Party Information</legend>
                                                <input type="text" name="party[1][name]" value="{{old('party.1.name')}}" class="form-control {{ $errors->has('party.1.name') ? ' is-invalid' : '' }}" placeholder="Enter Second Party Name"/><br>
                                                <input type="email" name="party[1][email]" value="{{old('party.1.email')}}" class="form-control {{ $errors->has('party.1.email') ? ' is-invalid' : '' }}" placeholder="Enter Second Party Email"/><br>
                                                <input type="number" name="party[1][contact]" value="{{old('party.1.contact')}}" class="form-control {{ $errors->has('party.1.contact') ? ' is-invalid' : '' }}" placeholder="Enter Second Party Contact"/><br>
                                                <input type="text" name="party[1][contact_person_name]" value="{{old('party.1.contact_person_name')}}" class="form-control {{ $errors->has('party.1.contact_person_name') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Name"/><br>
                                                <input type="text" name="party[1][contact_person_designation]" value="{{old('party.1.contact_person_designation')}}" class="form-control {{ $errors->has('party.1.contact_person_designation') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Designation"/><br>
                                                <input type="number" name="party[1][contact_person_contact]" value="{{old('party.1.contact_person_contact')}}" class="form-control {{ $errors->has('party.1.contact_person_contact') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Phone"/><br>
                                                <input type="email" name="party[1][contact_person_email]" value="{{old('party.1.contact_person_email')}}" class="form-control {{ $errors->has('party.1.contact_person_email') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Email"/>

                                            </fieldset>
                                            <a href="javascript:void(0);" class="add_button" title="Add field" style="position: absolute;
                                             margin: -110px 0px 0px 350px;"><img src="{{url('assets/img/add.png')}}" height="20"/></a>
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
     $(document).ready(function(){
         var maxField = 20; //Input fields increment limitation
         var x = 3;
         var addButton = $('.add_button'); //Add button selector
         var wrapper = $('.field_wrapper'); //Input field wrapper


         //Once add button is clicked
         $(addButton).click(function(){
             //Check maximum number of input fields
             if(x < maxField){

                 var fieldHTML = '<div style="margin-top:5px"><fieldset class="border p-2">' +
                     '<legend  class="w-auto">'+inWords(x)+' Party Information </legend>' +
                     '<input type="text" class="form-control" name="party['+x+'][name]" value="" placeholder="Enter '+inWords(x)+'Party Name"/><br>' +
                     '<input type="email" class="form-control" name="party['+x+'][email]" value="" placeholder="Enter '+inWords(x)+'Party Email"/><br>'+
                     '<input type="number" class="form-control" name="party['+x+'][contact]" value="" placeholder="Enter '+inWords(x)+'Party Contact"/><br>' +
                     '<input type="text" name="party['+x+'][contact_person_name]" value="" class="form-control" placeholder="Enter Contact Person Name"/><br>'+
                     '<input type="text" name="party['+x+'][contact_person_designation]" value="" class="form-control" placeholder="Enter Contact Person Designation"/><br>'+
                     '<input type="number" name="party['+x+'][contact_person_contact]" value="" class="form-control" placeholder="Enter Contact Person Phone"/><br>'+
                     '<input type="email" name="party['+x+'][contact_person_email]" value="" class="form-control" placeholder="Enter Contact Person Email"/>'+
                     '</fieldset>'+
                     '<a href="javascript:void(0);" class="remove_button" style="position:absolute;margin:-215px 0px 0px 350px;">' +
                     '<img src="{{url('assets/img/remove.png')}}" height="20"/></a></div>'; //New input field html

                 x++; //Increment field counter
                 $(wrapper).append(fieldHTML); //Add field html
             }
         });

         //Once remove button is clicked
         $(wrapper).on('click', '.remove_button', function(e){
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
 </script>

@endsection
