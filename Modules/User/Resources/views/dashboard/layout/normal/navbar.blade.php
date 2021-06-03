
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        @php
            $url=\Illuminate\Support\Facades\Route::current()->getName();
            $module=explode('.',$url);
            $module_name=$module[0];
            $place=$module[1];
        @endphp

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{($place=='dashboard')?'active':''}}">
                <a class="nav-link" href="{{route('user.dashboard')}}">
                    <i class="fa fa-home"></i>
                    Home
                </a>
            </li>
                @foreach($permission as $permissionData)
                      @if(array_key_exists('module',$permissionData))
                          @foreach($permissionData['module']['name'] as $moduleData)

                        @if(array_key_exists($moduleData,$permissionData['module']))

                            <li class="nav-item dropdown {{(strtolower($module_name)==strtolower($moduleData))?'active':''}}">
                <a class="nav-link dropdown-toggle" href="#" id="{{$moduleData}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$moduleData}}
                </a>

                <div class="dropdown-menu" aria-labelledby="{{$moduleData}}">

                    @if(array_key_exists($moduleData,$permissionData['module']))

                        @if($permissionData['module'][$moduleData]['create']==1)

                    <a class="dropdown-item" href="{{route(strtolower($moduleData).'.register')}}">Register/Create {{$moduleData}}</a>

                            @endif
                        @if($permissionData['module'][$moduleData]['view']==1 || $permissionData['module'][$moduleData]['edit']==1 || $permissionData['module'][$moduleData]['delete']==1 )

                    <a class="dropdown-item" href="{{route(strtolower($moduleData).'.show')}}">View all {{$moduleData}}</a>

                        @endif
                        @endif


                </div>
                            </li>
                    @endif
                    @endforeach
                @endif
            @endforeach

            <li class="nav-item {{($url=='manual')?'active':''}}">
                <a class="nav-link" href="{{route('manual.show')}}">
                    User Manual
                </a>
            </li>

        </ul>
        <div class="nav-item dropdown" style="margin-right: 100px">
            <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('user.edit.profile')}}">Edit Profile</a>
                <a class="dropdown-item" href="{{route('user.change.password')}}">Change password</a>
                <a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>
            </div>
        </div>

    </div>
</nav>
