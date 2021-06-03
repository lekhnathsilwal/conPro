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
            <li class="nav-item {{($url=='user.dashboard')?'active':''}}">
                <a class="nav-link" href="{{route('user.dashboard')}}">
                    Home
                </a>
            </li>
                <li class="nav-item dropdown {{($module_name=='organization')?'active':''}}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Organization
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{route('organization.register')}}">Register/Create Organization</a>
                        <a class="dropdown-item" href="{{route('organization.show')}}">View all Organizations</a>

                    </div>
                </li>

            <li class="nav-item dropdown {{($module_name=='project')?'active':''}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('project.show')}}">Show Projects</a>

                </div>
            </li>


            <li class="nav-item dropdown {{($module_name=='group')?'active':''}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Group
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('group.register')}}">Set User Roles</a>
                    <a class="dropdown-item" href="{{route('group.show')}}">View all Roles</a>

                </div>
            </li>

            <li class="nav-item dropdown" {{($module_name=='user')?'active':''}}>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{route('user.register')}}">Register User</a>
                    <a class="dropdown-item" href="{{route('user.show')}}">View all Users</a>

                </div>
            </li>

            <li class="nav-item dropdown {{($module_name=='client')?'active':''}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clients
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('client.show')}}">Show Clients</a>
                </div>
            </li>

            <li class="nav-item dropdown {{($module_name=='employee')?'active':''}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Employee
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('employee.show')}}">Show Employee</a>
                    <a class="dropdown-item" href="{{route('employee.report.show.all')}}">Show Employee Work Report</a>

                </div>
            </li>

            <li class="nav-item dropdown {{($module_name=='trash')?'active':''}}">
                <a class="nav-link" href="{{route('trash.show')}}" role="button" aria-haspopup="true" aria-expanded="false">
                    Trash
                </a>
            </li>

            <li class="nav-item dropdown {{($module_name=='manual')?'active':''}}">
                <a class="nav-link" href="{{route('manual.index')}}" role="button" aria-haspopup="true" aria-expanded="false">
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
