<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;

class EmployeeDashboardController extends Controller
{

    public function index()
    {
        return view('employee::dashboard.index');
    }


    public function destroy()
    {
        if(Auth::guard('employee')->check())
        {
            Auth::guard('employee')->logout();
            return redirect()->route('employee.login')->with('success_message','Employee Logged out');
        }
    }
}
