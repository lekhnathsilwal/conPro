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

                    <div class="card-header">{{ __('Edit Group') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('group.update',['id'=>$group->id]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Group Name<span>*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $group->group }}" required autofocus>

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
                                    @if(Auth::user()->type!=0)

                                        @if(array_key_exists('module',$permission[0]))

                                            @foreach($permission[0]['module']['name'] as $moduleName)
                                                <li style="display: block;float: left;margin-left: 20px;">

                                                {{$moduleName}}

                                                    <ul>
                                                                @foreach($permission[0]['module'][$moduleName] as $entity=>$userModuleDataPermission)

                                                                     @if($userModuleDataPermission==1)


                                                                        @if(array_key_exists($moduleName,$data))
                                                                            @php  $modulePermission=$data[$moduleName][$entity];   @endphp
                                                                        @else @php  $modulePermission=null;   @endphp @endif

                                                                            @php $title=$entity; @endphp
                                                                            @if($moduleName=="Trash") @if($entity=="edit") @php $title='restore'; @endphp @endif @endif

                                                                            <li style="list-style-type: none">
                                                                                <input type="checkbox" name="permission[{{$moduleName}}][{{substr($entity,0,1)}}]" value="1" id="checkItem" {{($modulePermission==1)? 'checked' : ''}}>&nbsp;{{$title}}
                                                                                &nbsp;
                                                                            </li>
                                                                    @endif

                                                                @endforeach

                                                    </ul>

                                                </li>
                                            @endforeach
                                         @endif
                                    @else
                                        @foreach($modules as $moduleData)
                                            <li style="display: block;float: left;margin-left: 20px">
                                                {{$moduleData->name}}

                                                @if(array_key_exists($moduleData->name,$data))
                                                    @php  $modulePermissionadmin=$data[$moduleData->name];   @endphp
                                                @endif

                                                @if($moduleData->name=="Trash")
                                                    <ul>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][e]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['edit']==1)?'checked':'':''}} id="{{$moduleData->name}}">&nbsp;&nbsp;RESTORE</li>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][d]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['delete']==1)?'checked':'':''}} id="{{$moduleData->name}}">&nbsp;&nbsp;DELETE</li>
                                                    </ul>
                                                @elseif($moduleData->name=="Trash")
                                                    <ul>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][e]" value="1"  id="{{$moduleData->name}}">&nbsp;&nbsp;RESTORE</li>
                                                        <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][d]" value="1"  id="{{$moduleData->name}}">&nbsp;&nbsp;DELETE</li>

                                                    </ul>
                                                @else

                                                <ul>
                                                    <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][c]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['create']==1)?'checked':'':''}}  id="{{$moduleData->name}}">&nbsp;&nbsp;CREATE</li>
                                                    <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][v]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['view']==1)?'checked':'':''}} id="{{$moduleData->name}}">&nbsp;&nbsp;VIEW</li>
                                                    <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][e]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['edit']==1)?'checked':'':''}} id="{{$moduleData->name}}">&nbsp;&nbsp;EDIT</li>
                                                    <li style="list-style-type: none"><input type="checkbox" name="permission[{{$moduleData->name}}][d]" value="1" {{(array_key_exists($moduleData->name,$data))?($data[$moduleData->name]['delete']==1)?'checked':'':''}} id="{{$moduleData->name}}">&nbsp;&nbsp;DELETE</li>
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
                                        {{ __('Update Data') }}
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
