@extends('employee::dashboard.layout.master')
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
            <h4>Report List</h4>

            @php $i=1; @endphp
            @if($data->count()>0)
                <table id="report_table" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        @if(Auth::guard('employee')->user()->departments_id==null)
                            <th>Employee Name</th>
                        @endif
                        <th>Report Date</th>
                        <th>Task</th>
                        <th>For Client</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $reportRecord)
                        <tr>
                            <td>{{$i++}}</td>
                            @if(Auth::guard('employee')->user()->departments_id==null)
                                <td>{{$reportRecord->Employee->name}}</td>
                            @endif
                            <td>{{$reportRecord->date}}</td>
                            <td>{{strtoupper($reportRecord->dailyTask->task_nature)}}</td>
                            <td>{{($reportRecord->client_id==0)?"Other":$reportRecord->client->company}}</td>
                            <td><a href="{{route('report.detail',['id'=>$reportRecord->id])}}"><i class="fa fa-file">&nbsp;Report Detail</i></a></td>
                            <td><a href="{{route('report.edit',['id'=>$reportRecord->id])}}"><i class="fa fa-edit">&nbsp;Edit</i> </a>
                                <a href="javascript:void(0)" onclick="del({{$reportRecord->id}});"><i class="fa fa-trash-o">&nbsp;Delete</i> </a> </td>

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
                window.location.href="delete/"+id;
            }
        }

    </script>


@endsection
