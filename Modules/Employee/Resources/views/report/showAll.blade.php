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
        .col-md-8
        {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            margin-left: 165px;
        }
        .col-md-8 h6
        {
            float: left;
            margin-right: 10px;
        }

    </style>


    <div class="container">
        <div class="table-responsive">
            @include('common.flash')
            <h4>Report List</h4>

            @php $i=1; @endphp
            @if(count($data)>0)

                <table id="report_table" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Date</th>
                        <th>Employee</th>
                        <th>For Client</th>
                        <th>Organization</th>
                        <th>Department</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $reportRecord)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$reportRecord->date}}</td>
                            <td>{{$reportRecord->employee->name}}</td>
                            <td>{{($reportRecord->client_id==0)?"Others":$reportRecord->client->company}}</td>
                            <td>{{$reportRecord->organization->name}}</td>
                            <td>{{($reportRecord->departments_id==null)?'Overall':$reportRecord->Department->name}}</td>
                            <td><a href="{{route('employee.report.detail',['id'=>$reportRecord->id])}}"><i class="fa fa-file">&nbsp;Report Detail</i></a></td>
                            <td><a href="javascript:void(0)" onclick="del({{$reportRecord->id}});"><i class="fa fa-trash-o">&nbsp;Delete</i> </a> </td>

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
            $('#report_table').DataTable();
        } );


        function del(id)
        {
            if(window.confirm("Are you sure to delete report ?"))
            {
                window.location.href="{{url('/employee/report')}}/delete/"+id;
            }
        }

    </script>


@endsection
