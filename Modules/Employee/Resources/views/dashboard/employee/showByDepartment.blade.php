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
            <h4>Employee List by {{$data->first()->Department->name}}</h4>
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
                    <tbody>
                    @if(count($data)>0)
                        @foreach($data as $empInfo)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$empInfo->name}}</td>
                                <td>{{$empInfo->email}}</td>
                                <td>{{$empInfo->contact}}</td>
                                <td><a href="{{route('employee.detail',['id'=>$empInfo->id])}}" alt="View Employee Profile" title="View Employee Profile"><i class="fa fa-user">View Employee Profile</i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No Employee Associated till now</td>
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
