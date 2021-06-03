@extends('user::dashboard.layout.master')
@section('content')
    <div class="container">
        @include('common.flash')
        <h4>User Group List</h4>
        <div class="table-responsive">
            @php $count=count($group);$i=1; @endphp
            @if($count>0)
            <table class="table" id="role_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Permission Area</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group as $role)
                    @if($role->group!='Super Admin')
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$role->group}}</td>
                    <td><a href="{{route('group.permission.show',['id'=>$role->id])}}">Permissions</a> </td>


                    <td>
                        @if(count($permission)>0)
                            @if(array_key_exists('Group',$permission[0]['module']))
                                    @if($permission[0]['module']['Group']['edit']==1 || $role->created_by==Auth::id())

                                        <a href="{{route('group.edit',['id'=>$role->id])}}">Edit</a>&nbsp;&nbsp;

                                    @endif


                            @if($permission[0]['module']['Group']['delete']==1 || $role->created_by==Auth::id())

                                <a href="{{route('group.delete',['id'=>$role->id])}}">Delete</a>

                            @endif

                            @else

                                <p>N/A</p>

                            @endif
                            @else

                            <a href="{{route('group.edit',['id'=>$role->id])}}"><i class="fa fa-edit">&nbsp;Edit</i> </a>&nbsp;&nbsp;&nbsp;&nbsp;

                            <a href="{{route('group.delete',['id'=>$role->id])}}"><i class="fa fa-trash">&nbsp;Delete</i> </a>

                            @endif


                    </td>


                </tr>
                    @php $i++; @endphp
                        @endif
                    @endforeach

                </tbody>
            </table>
                {{$group->links()}}

            @else
            <p>No record found!</p>
            @endif
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#role_table').DataTable();
        } );
    </script>

@endsection
