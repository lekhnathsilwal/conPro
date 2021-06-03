@extends('user::dashboard.layout.master')
@section('content')

    <script type="text/javascript">//<![CDATA[

        $(function(){

            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

        });

        //]]></script>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    @include('common.flash')

                    <div class="card-header">{{ __('Add New Group') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('group.register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Group Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <fieldset class="border p-2">
                                <legend  class="w-auto">Set Permission for Modules</legend>

                                <ul class="listyle">

                                    <input type="checkbox" id="checkAll">&nbsp;&nbsp;SELECT ALL
                                    <hr />
                                    @if(count($permission)>0)
                                    @foreach($permission[0]['module']['name'] as $userModuleDataName)
                                                <li style="display: block;float: left;margin-left: 20px;">
                                           {{$userModuleDataName}}

                                        @if(array_key_exists($userModuleDataName,$permission[0]['module']))

                                            <ul>

                                            @foreach($permission[0]['module'][$userModuleDataName] as $key=>$userModuleDataPermission)
                                                    @if($userModuleDataPermission==1)
                                                        @php $entity=$key; @endphp
                                                        @if($userModuleDataName=="Trash") @if($key=="edit") @php $entity='restore'; @endphp @endif @endif
                                                    <li style="list-style-type: none">
                                                        <input type="checkbox" name="permission[{{$userModuleDataName}}][{{substr($key,0,1)}}]" value="1" id="checkItem">&nbsp;
                                                        &nbsp;{{$entity}}
                                                    </li>
                                                    @endif
                                             @endforeach

                                            </ul>

                                            @endif
                                                </li>

                                    @endforeach
                                        @else
                                        @foreach($modules as $moduleData)

                                            <li style="display: block;float: left;margin-left: 20px">
                                                {{$moduleData->name}}
                                                @if($moduleData->name=="Trash")
                                                    <ul>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][e]" value="1" id="checkItem">&nbsp;&nbsp;RESTORE</li>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][d]" value="1" id="checkItem">&nbsp;&nbsp;DELETE</li>
                                                    </ul>
                                                @else

                                        <ul>

                                            <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][c]" value="1" id="checkItem">&nbsp;&nbsp;CREATE</li>
                                            <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][v]" value="1" id="checkItem">&nbsp;&nbsp;VIEW</li>
                                            <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][e]" value="1" id="checkItem">&nbsp;&nbsp;EDIT</li>
                                            <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][d]" value="1" id="checkItem">&nbsp;&nbsp;DELETE</li>
                                        </ul>
                                                    @endif

                                        </li>

                                        @endforeach

                                    @endif

                                </ul>

                            </fieldset>



                                <br><br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
