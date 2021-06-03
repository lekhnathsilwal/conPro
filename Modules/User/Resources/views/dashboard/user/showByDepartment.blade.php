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
            <h4>User List by Department {{$data->name}}</h4>
            @php $i=1; @endphp
             @if(count($data)>0)
                <table id="user_table" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @if(count($data->User)>0)
                    @foreach($data->User as $userInfo)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$userInfo->name}}</td>
                            <td>{{$userInfo->email}}</td>
                            <td>{{$userInfo->contact}}</td>
                            <td><a href="{{route('user.detail',['id'=>$userInfo->id])}}" alt="View User Profile" title="View User Profile"><i class="fa fa-user">View User Profile</i></a></td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">No User Associated till now</td>
                    </tr>
                    @endif

                    </tbody>

                </table>
            @else
                <p>No Record Found!</p>
            @endif
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable();
        } );
    </script>


@endsection
