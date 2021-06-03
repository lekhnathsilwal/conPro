@extends('user::dashboard.layout.master')
@section('content')
    <div class="container">
        @include('common.flash')
        <h4>Department List</h4>
        <div class="table-responsive">
            @php $count=count($data);$i=1; @endphp
            @if($count>0)
                <table class="table" id="department_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>User List</th>
                        <th>Employee List</th>
                        <th>Organization</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $department)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$department->name}}</td>
                                <td><a href="{{route('user.showBy.department',['id'=>$department->id])}}"><i class="fa fa-user">&nbsp;View Associated Users</i></a> </td>
                                <td><a href="{{route('employee.showBy.department',['id'=>$department->id])}}"><i class="fa fa-user">&nbsp;View Associated Employee</i></a></td>
                                <td>{{$department->Organization->name}}</td>
                                <td><a href="{{route('user.detail',['id'=>$department->created_by])}}">{{$department->DepartmentCreatedBy->name}}</a></td>



                                <td>
                                    @if(count($permission)>0)
                                        @if(array_key_exists('Department',$permission[0]['module']))
                                            @if($department->created_by==Auth::id() || $permission[0]['module']['Department']['edit']==1)

                                                <a href="{{route('department.edit',['id'=>$department->id])}}"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp;

                                            @else
                                                <p>N/A</p>
                                            @endif
                                        @else
                                            <p>N/A</p>
                                        @endif
                                    @endif


                                </td>


                            </tr>

                    @endforeach

                    </tbody>
                </table>

            @else
                <p>No record found!</p>
            @endif
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#department_table').DataTable();
        } );
    </script>

@endsection
