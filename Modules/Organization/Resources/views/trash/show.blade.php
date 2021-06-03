@extends('user::dashboard.layout.master')
<style>
    table.dataTable thead th {
        white-space: nowrap
    }
    table.dataTable tr td
    {
        white-space: nowrap;
    }

</style>
@section('content')
    <div class="container">
        @if(Auth::user()->type==0)
            @php $isDeletePermission=1;$isEditPermission=1; $org_id='NA'; @endphp
        @else
            @if(count($permission)>0)
                @if(array_key_exists('Trash',$permission[0]['module']))

                    @php $org_id=Auth::user()->organizations_id; @endphp

                    @if($permission[0]['module']['Trash']['delete']==1)
                        @php $isDeletePermission=1; @endphp
                    @else
                        @php $isDeletePermission=0; @endphp
                    @endif

                    @if($permission[0]['module']['Trash']['edit']==1)
                        @php $isEditPermission=1; @endphp
                    @else
                        @php $isEditPermission=0; @endphp
                    @endif

                @endif
            @endif
        @endif

        <div class="card">
            @include('common.flash')
            @if(count($data)>0)
            <div class="card-header">{{ __('Trash') }} <span style="float: right">@if($isEditPermission==1)<a href="{{route('trash.restore.all')}}"><i class="fa fa-undo">&nbsp;Restore All</i></a>@endif
                @if($isDeletePermission==1)&nbsp;&nbsp;<a href="{{route('trash.delete.all',['org_id'=>$org_id])}}"><i class="fa fa-trash">&nbsp;Delete All Permanently</i> </a>@endif
                </span></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

                                        @php $i=1; $active=null; @endphp

                                        @foreach($data['name'] as $module_name)

                                            @php if($i==1){ $active=$module_name; } @endphp

                                            <li class="nav-item">
                                                <a class="nav-link {{($i==1)?'active':''}}" id="{{$module_name}}Info-tab" data-toggle="tab" href="#{{$module_name}}Info" role="tab" aria-controls="{{$module_name}}Info" aria-selected="true">{{$module_name}}</a>
                                            </li>

                                            @php $i++ @endphp

                                         @endforeach

                                    </ul>

                                    <div class="tab-content ml-1" id="myTabContent">

                                        @foreach($data['name'] as $module_content)

                                                <div class="tab-pane fade show {{($active==$module_content)?'active':''}}" id="{{$module_content}}Info" role="tabpanel" aria-labelledby="{{$module_content}}Info-tab">

                                                    @if(array_key_exists($module_content,$data))


                                                        <div style="float: right">@if($isEditPermission==1)<a href="{{route('trash.restore.module',['module'=>$module_content])}}"><i class="fa fa-undo">&nbsp;Restore all {{$module_content}}</i></a>@endif
                                                        &nbsp;&nbsp; @if($isDeletePermission==1) <a href="{{route('trash.delete.module',['module'=>$module_content,'org_id'=>$org_id])}}"><i class="fa fa-trash-o">&nbsp;Delete all {{$module_content}}</i></a> @endif
                                                        </div>

                                                        <table class="table table-responsive" id="trash_table_{{$module_content}}">
                                                            <thead>
                                                            <tr>
                                                                @foreach($data[$module_content] as $key=>$val)
                                                                    @php  unset($val['user_id'],$val['ID']);   @endphp
                                                                    @foreach($val as $trash_key=>$trash_value)

                                                                        <th scope="col">{{$trash_key}}</th>

                                                                    @endforeach
                                                                        @break
                                                                @endforeach
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($data[$module_content] as $value)
                                                                @php $user_id=$value['user_id'];$id=$value['ID']; unset($value['user_id'],$value['ID']); @endphp
                                                                <tr>
                                                                @foreach($value as $entity=>$trash_value)
                                                                    @if($entity=="Deleted by")
                                                                            <td><a href="{{route('user.detail',['id'=>$user_id])}}">{{$trash_value}}</a></td>
                                                                    @else
                                                                            <td>{{$trash_value}}</td>
                                                                    @endif
                                                                @endforeach
                                                                    <td>@if($isEditPermission==1)<a href="{{route('trash.restore.data',['module'=>$module_content,'id'=>$id])}}"><i class="fa fa-undo">&nbsp;Restore</i></a>@endif
                                                                        &nbsp;&nbsp; @if($isDeletePermission==1) <a href="{{route('trash.delete.data',['module'=>$module_content,'id'=>$id])}}"><i class="fa fa-trash-o">&nbsp;Delete Permanently</i></a> @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                        <script>
                                                            $(document).ready(function() {
                                                                $('#trash_table_{{$module_content}}').DataTable();
                                                            } );
                                                        </script>
                                                        @endif

                                                </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            @else
                <p style="padding: 20px;">No Trash record found!</p>
            @endif
        </div>
    </div>

@endsection

