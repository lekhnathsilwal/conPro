<?php

namespace App\Http\Controllers;
use Modules\Group\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->middleware('auth');
        $this->permission=new PermissionController();
    }
    public function dms(){
        $permission=$this->permission->showPermission(Auth::user()->id);
        return view('user::dashboard.index');
    }
}
