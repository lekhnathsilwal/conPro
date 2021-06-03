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
            <li class="nav-item {{($url=='employee.dashboard')?'active':''}}">
                <a class="nav-link" href="{{route('employee.dashboard')}}">
                    Home
                </a>
            </li>

            <li class="nav-item {{($place=='register')?'active':''}}">
                <a class="nav-link" href="{{route('report.register')}}">
                    Add Daily Report
                </a>
            </li>

            <li class="nav-item {{($place=='show')?'active':''}}">
                <a class="nav-link" href="{{route('report.show')}}">
                    View All Reports
                </a>
            </li>

        </ul>


        <div class="nav-item dropdown" style="margin-right: 100px">
            <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::guard('employee')->user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('employee.view.profile')}}">View Profile</a>
                <a class="dropdown-item" href="{{route('employee.update.profile')}}">Edit Profile</a>
                <a class="dropdown-item" href="{{route('employee.change.password')}}">Change password</a>
                <a class="dropdown-item" href="{{route('employee.logout')}}">Logout</a>
            </div>
        </div>




    </div>
</nav>
