@extends('user::dashboard.layout.master')
<style>

    .col-md-4
    {
        border: 1px green solid;
        border-radius: 10px;
        padding: 10px;
        margin:10px 10px 10px 0px;
        max-height: 180px;
    }
    .col-md-4 img
    {
        height: 150px;
        float:left;
        max-width: 45%;
    }
    .col-md-4 p
    {
        padding-left: 175px;
        font-weight: bold;
        font-size:small;
    }

</style>
@section('content')


    <div class="container">
        <div class="table-responsive">
            @include('common.flash')
            <h4>User List</h4>
            @if(Auth::user()->type==0)
            <div class="showby">
                <ul>
                    <li><a href="{{route('user.show')}}">Show Self Created</a></li>
                    <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">Show by Company</a></li>

                </ul>

            </div>
                @endif
        </div>
        <div class="row">
            @if(count($user)>0)
                @foreach($user as $users)
                    <div class="col-md-4">
                        <img src="{{($users->image!=null)?asset('assets/images/user-img/'.$users->image):asset('assets/img/profile-photos/no-pic.jpg')}}" style="height:150px;"/>
                        <p>
                            <a href="{{route('user.detail',['id'=>$users->id])}}">{{$users->name}}</a><br>
                            {{$users->email}}<br>
                            {{($users->type!=0) ? ($users->organizations_id!=null)?$users->Organization->name:'' : 'Not Associated' }}<br>
                            {{$users->designation}}<br>
                            {{$users->contact}}<br>

                            @if(count($permission)>0)
                                @if(array_key_exists('User',$permission[0]['module']))
                                        @if($permission[0]['module']['User']['edit']==1 || $users->created_by==Auth::id())
                                                <a href="{{route('user.edit',['id'=>$users->id])}}"><i class="fa fa-paste">Edit</i></a>&nbsp;&nbsp;
                                        @endif
                                        @if($permission[0]['module']['User']['delete']==1 || $users->created_by==Auth::id())

                                                <a href="#" id="delete"><i class="fa fa-trash-o">Delete</i></a>
                                        @endif
                                @endif
                            @else
                            <a href="{{route('user.edit',['id'=>$users->id])}}"><i class="fa fa-paste">&nbsp;Edit</i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a  href="{{route('user.delete',['id'=>$users->id])}}"  id="delete"><i class="fa fa-trash-o">&nbsp;Delete</i></a>
                        @endif
                    </p>
                    </div>
                @endforeach
            @else
            <p>No Record Found!</p>
            @endif
        </div>
        {{$user->links()}}
    </div>



    <div class="modal fade bd-example-modal-sm" style="min-width: 100px" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div style="margin: 20px 50px;">
                    @foreach($org_data as $organization)
                    <p><a href="{{route('user.showByOrganization',['id'=>$organization->id])}}">{{$organization->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#delete').on('click', function () {
            if(confirm('Are you sure?'))
            {
                var id = $(this).attr('data-id');
            }
        });
    </script>


@endsection
