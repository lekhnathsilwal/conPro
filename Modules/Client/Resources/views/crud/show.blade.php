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
            <h4>Client List</h4>

            @php $i=1; @endphp
            @if(count($data)>0)
                <table id="client_table" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $clientRecord)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$clientRecord->company}}</td>
                            <td>{{$clientRecord->email}}</td>
                            <td>{{$clientRecord->contact}}</td>
                            <td><a href="{{URL::SignedRoute('client.show.detail',['id'=>$clientRecord->id])}}">View Detail Information</a></td>
                            <td>

                                @if(count($permission)>0)
                                    @if(array_key_exists('Client',$permission[0]['module']))

                                            @if($permission[0]['module']['Client']['edit']==1 || $clientRecord->created_by==Auth::id())

                                                <a href="{{route('client.edit',['id'=>$clientRecord->id])}}"><i class="fa fa-paste">&nbsp;Edit</i> </a>&nbsp;&nbsp;

                                            @endif


                                            @if($permission[0]['module']['Client']['delete']==1 || $clientRecord->created_by==Auth::id())

                                                <a href="javascript:void(0)" onclick="del({{$clientRecord->id}})"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

                                            @endif

                                    @else

                                        <p>N/A</p>

                                    @endif
                                @else

                                    <a href="javascript:void(0)" onclick="del({{$clientRecord->id}})"><i class="fa fa-trash-o">&nbsp;Delete</i></a>

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

    <script>
        $(document).ready(function() {
            $('#client_table').DataTable();
        } );
        function del(id)
        {
            if(window.confirm('Are you sure to delete client ?'))
            {
                window.location.href="{{url('client')}}/delete/"+id;
            }
        }
    </script>


@endsection
