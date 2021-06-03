@extends('user::dashboard.layout.master')
@section('content')

    <style>
        table.dataTable thead th {
            white-space: nowrap
        }
        table.dataTable tr td
        {
            white-space: nowrap;
            text-align: center;
        }

    </style>
    <div class="container">

        <script>
            $(document).ready(function() {
                var table = $('#project_table').DataTable();
            });
        </script>






        <div class="table-responsive">
            @include('common.flash')
            <h4>Project Report</h4>
            @if(count($data)>0)
                @php $max=0 @endphp
                @foreach($data as $projects)
                    @php $count=count($projects->Project_Partie);@endphp
                    @if($count>0)
                        @php $max=($max>$count)?$max:$count;@endphp
                    @endif
                @endforeach
            @php $i=1;

            $num=array('1'=>'First','2'=>'Second','3'=>'Third','4'=>'Fourth','5'=>'Fifth','6'=>'Sixth','7'=>'Seventh','8'=>'Eighth','9'=>'Ninth','10'=>'Tenth');

            @endphp
                <table id="project_table" class="table table-responsive" style="overflow: scroll" >
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
                        <th>Agreement Type</th>
                        <th>Agreement Signed</th>
                        <th>Agreement Expiry</th>
                        <th>Project Cost</th>
                        <th>Agreement Duration</th>
                        <th>Annual Maintenance Cost</th>

                        @for($k=1;$k<=$max;$k++)
                            <th>{{$num[$k]}} Party Company Name</th>
                            <th>{{$num[$k]}} Party Email</th>
                            <th>{{$num[$k]}} Party Contact</th>
                            <th>Authorized Person</th>
                            <th>Designation</th>
                            <th>Contact</th>
                            <th>Email</th>
                        @endfor



                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data)>0)
                        @foreach($data as $projects)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$projects->file_number}}</td>
                            <td><a href="{{URL::SignedRoute('project.detail',['id'=>$projects->id])}}" title="Click for more info">{{$projects->name}}</a></td>
                            <td>{{$projects->type}}</td>
                            <td><a href="{{route('user.detail',['id'=>$projects->created_by])}}">{{($projects->created_by!=null)?$projects->User->name:'N/A'}}</a></td>
                            <td>{{($projects->organizations_id!=null)?$projects->Organization->name:''}}</td>
                            <td>{{($projects->department_id==null)?($projects->created_by!=null)?$projects->User->User_Role->Role->group." Created":"N/A":$projects->Department->name}}</td>
                            <td>{{($projects->position==1)?'Ongoing':'Completed'}}</td>
                            <td>{{$projects->agreement_type}}</td>
                            <td>{{$projects->start}}</td>
                            <td>{{$projects->deadline}}</td>
                            <td>{{$projects->project_cost}}</td>
                            <td>{{$projects->agreement_duration." ".$projects->duration_type}}</td>
                            <td>{{$projects->amc}}</td>

                            @php $count_party=count($projects->Project_Partie); @endphp

                            @if($count_party>0)
                                @foreach($projects->Project_Partie as $parties)
                                    <td>{{$parties->name}}</td>
                                    <td>{{$parties->email}}</td>
                                    <td>{{$parties->contact}}</td>
                                    <td>{{$parties->contact_person_name}}</td>
                                    <td>{{$parties->contact_person_designation}}</td>
                                    <td>{{$parties->contact_person_contact}}</td>
                                    <td>{{$parties->contact_person_email}}</td>
                                @endforeach
                                    @if($max>$count_party)
                                    @php $remain=$max-$count_party@endphp
                                @for($z=1;$z<=$remain;$z++)

                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                  @endfor
                                        @endif

                            @endif


                        </tr>
                        @endforeach
                        @endif

                    </tbody>

                </table>
            @endif
            <p>No record found</p>
        </div>

    </div>





@endsection
