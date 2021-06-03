@extends('user::dashboard.layout.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Add New Client') }}</div>
                    <form method="POST" action="{{ route('client.register') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Company Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="Enter Company Name(eg: Shiran Technologies Pvt.Ltd.)" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" required autofocus>

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
                                    <textarea id="location" placeholder="Enter Client Contact Address" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" required>{{ old('location') }}</textarea>

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
                                    <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="eg: example@example.com" >

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
                                    <input class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" placeholder="eg:01-4-000000,9851000000">
                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Client Contact Persons') }}</label>

                                <div class="col-md-6">

                                    <div class="field_wrapper">
                                        <div>
                                            <fieldset class="border p-2">
                                                <legend  class="w-auto">First Contact Person Information</legend>
                                                <input type="text" name="party[0][name]" value="{{old('party.0.name')}}" class="form-control {{ $errors->has('party.0.name') ? ' is-invalid' : '' }}" placeholder="Enter First Contact Person name"  required/><br>
                                                <input type="email" name="party[0][email]" value="{{old('party.0.email')}}" class="form-control {{ $errors->has('party.0.email') ? ' is-invalid' : '' }}" placeholder="Enter First Contact Person Email" required/><br>
                                                <input type="number" name="party[0][contact]" value="{{old('party.0.contact')}}" class="form-control {{ $errors->has('party.0.contact') ? ' is-invalid' : '' }}" placeholder="Enter First Contact Person Phone" required/><br>
                                                <input type="text" name="party[0][designation]" value="{{old('party.0.designation')}}" class="form-control {{ $errors->has('party.0.designation') ? ' is-invalid' : '' }}" placeholder="Enter Contact Person Designation" required/><br>
                                            </fieldset>

                                            <a href="javascript:void(0);" class="add_button" title="Add field" style="position: absolute;
                                             margin: -110px 0px 0px 450px;"><img src="{{url('assets/img/add.png')}}" height="20"/></a>
                                        </div>
                                    </div>
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
            var x = 2;
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper


            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){

                    var fieldHTML = '<div style="margin-top:5px"><fieldset class="border p-2">' +
                        '<legend  class="w-auto">'+inWords(x)+' Contact Person Information </legend>' +
                        '<input type="text" class="form-control" name="party['+x+'][name]" value="" placeholder="Enter '+inWords(x)+'Contact Person Name"/><br>' +
                        '<input type="email" class="form-control" name="party['+x+'][email]" value="" placeholder="Enter '+inWords(x)+'Contact Person Email"/><br>'+
                        '<input type="number" class="form-control" name="party['+x+'][contact]" value="" placeholder="Enter '+inWords(x)+'Contact Person Phone"/><br>' +
                        '<input type="text" name="party['+x+'][designation]" value="" class="form-control" placeholder="Enter '+inWords(x)+'Contact Person Designation"/><br>'+
                        '</fieldset>'+
                        '<a href="javascript:void(0);" class="remove_button" style="position:absolute;margin:-215px 0px 0px 450px;">' +
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
