@extends('user::dashboard.layout.master')
@section('content')

    <style>
        table.dataTable thead th {
            white-space: nowrap
        }
        table.dataTable tr td
        {
            white-space: nowrap;
        }

    </style>


    <div class="container">
        <div class="table-responsive">
            <a href="{{route('project.report')}}" style="float: right"><i class="fa fa-file">&nbsp;Project Report</i></a>
            @include('common.flash')
            <h4>Project List</h4>

            @php $i=1; @endphp
            @if(Auth::user()->type==0)
                <div class="showby">
                    <ul>
                        <li><a href="{{route('project.show')}}">Show Self Created</a></li>
                        <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">Show by Company</a></li>
                    </ul>

                </div>
            @endif
            @if(count($data)>0)
            <table id="project_table" class="table table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>File Number</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Created By</th>
                    <th>Organization</th>
                    <th>Department</th>
                    <th>Project Status</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="text-align: center">
                @foreach($data as $projectRecord)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$projectRecord->file_number}}</td>
                            <td>{{$projectRecord->name}}</td>
                            <td>{{$projectRecord->type}}</td>
                            <td><a href="{{route('user.detail',['id'=>$projectRecord->created_by])}}">{{($projectRecord->created_by!=null)?$projectRecord->User->name:'N/A'}}</a></td>
                            <td>{{($projectRecord->organizations_id!=null)?$projectRecord->Organization->name:''}}</td>
                            <td>{{($projectRecord->department_id==null)?($projectRecord->created_by!=null)?$projectRecord->User->User_Role->Role->group." Created":"N/A":$projectRecord->Department->name}}</td>
                            <td><a href="{{route('project.status.update',['id'=>$projectRecord->id])}}" alt="Set as Completed" title="Set as Completed">{{($projectRecord->position==1)?'Ongoing':'Completed'}}</a></td>
                            <td><a href="{{URL::SignedRoute('project.detail',['id'=>$projectRecord->id])}}">View Detail Information</a></td>
                            <td>

                                @if(count($permission)>0)
                                    @if(array_key_exists('Project',$permission[0]['module']))
                                        @if($projectRecord->created_by==Auth::id())
                                            @if($permission[0]['module']['Project']['edit']==1)

                                                <a href="{{route('project.edit',['id'=>$projectRecord->id])}}"><i class="fa fa-paste">&nbsp;Edit</i> </a>&nbsp;&nbsp;

                                            @endif


                                            @if($permission[0]['module']['Project']['delete']==1)

                                                <a href="{{route('project.delete',['id'=>$projectRecord->id])}}"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

                                            @endif
                                        @else
                                            <p>N/A</p>
                                        @endif
                                    @else

                                        <p>N/A</p>

                                    @endif
                                @else

                                    <a href="{{route('project.edit',['id'=>$projectRecord->id])}}"><i class="fa fa-paste">&nbsp;Edit</i> </a>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <a href="{{route('project.delete',['id'=>$projectRecord->id])}}"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

                                @endif

                            </td>
                        </tr>
                @endforeach

                </tbody>

            </table>
            @else
            <p>No Record Found!</p>
            @endif
        </div>

    </div>


    <div class="modal fade bd-example-modal-sm" style="min-width: 100px" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div style="margin: 20px 50px;">
                    @foreach($org_data as $organization)
                        <p><a href="{{route('project.showByOrganization',['id'=>$organization->id])}}">{{$organization->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#project_table').DataTable();
        } );
    </script>


@endsection
