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
            @include('common.flash')
            <h4>Employee List</h4>

            @php $i=1; @endphp
            @if(Auth::user()->type==0)
                <div class="showby">
                    <ul>
                        <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">Show by Company</a></li>
                    </ul>

                </div>
            @else
                <div class="showby">
                    <ul>
                        <li><a href="{{route('employee.report.show.all')}}">Employee Daily Report</a></li>
                    </ul>

                </div>
            @endif
            @if(count($data)>0)
                <table id="emp_table" class="table table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Designation</th>
                        <th>Created By</th>
                        <th>Organization</th>
                        <th>Department</th>
                        <th>Joined Date</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @foreach($data as $empRecord)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><a href="{{URL::SignedRoute('employee.detail',['id'=>$empRecord->id])}}">{{$empRecord->name}}</a></td>
                            <td>{{$empRecord->email}}</td>
                            <td>{{$empRecord->contact}}</td>
                            <td>{{$empRecord->designation}}</td>
                            <td><a href="{{route('user.detail',['id'=>$empRecord->created_by])}}">{{($empRecord->created_by!=null)?$empRecord->emp_created_by->name:'N/A'}}</a></td>
                            <td>{{($empRecord->organizations_id!=null)?$empRecord->organization->name:''}}</td>
                            <td>{{($empRecord->departments_id==null)?'Overall':$empRecord->department->name}}</td>
                            <td>{{($empRecord->joined_date==null)?'-':$empRecord->joined_date}}</td>
                            <td><a href="{{URL::SignedRoute('employee.detail',['id'=>$empRecord->id])}}">View Detail Information</a></td>
                            <td>

                                @if(count($permission)>0)
                                    @if(array_key_exists('Employee',$permission[0]['module']))
                                            @if($permission[0]['module']['Employee']['edit']==1 || $empRecord->created_by==Auth::id())

                                                <a href="{{route('employee.edit',['id'=>$empRecord->id])}}"><i class="fa fa-paste">&nbsp;Edit</i> </a>&nbsp;&nbsp;

                                            @endif


                                            @if($permission[0]['module']['Employee']['delete']==1 || $empRecord->created_by==Auth::id())

                                                <a href="{{route('employee.delete',['id'=>$empRecord->id])}}"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

                                            @endif
                                    @else

                                        <p>N/A</p>

                                    @endif
                                @else

                                    <a href="{{route('employee.delete',['id'=>$empRecord->id])}}"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

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

@if(Auth::user()->type==0)
    <div class="modal fade bd-example-modal-sm" style="min-width: 100px" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div style="margin: 20px 50px;">
                    @foreach($organization as $org)
                        <p><a href="{{route('employee.showByOrganization',['id'=>$org->id])}}">{{$org->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        $(document).ready(function() {
            $('#emp_table').DataTable();
        } );
    </script>


@endsection
