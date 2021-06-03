<?php

namespace Modules\Employee\Http\Controllers;

use App\Mail\EmployeePasswordReset;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeLoginController extends Controller
{
    public function index()
    {
        return view('employee::login.index');
    }

    public function login(Request $request)
    {
        $request->validate(['email'=>'required','password'=>'required']);

        $remember=$request->get('remember')==true  ?   true   :   false;
        $email=$request->get('email')."@lohaninbrothers.com";

        if(Auth::guard('employee')->attempt(['email'=>$email,'password'=>$request->get('password'),'status'=>1],$remember))
        {
            if(Auth::guard('employee')->user()->verified==0)
            {
                Auth::guard('employee')->logout();

                return redirect()->route('employee.login')->with('error_message','Account deactivated ! Please active your account by verifying email');
            }
            else {
                return redirect()->intended(route('employee.dashboard'));
            }
        }
        else
        {
            return redirect()->back()->with('error_message','Invalid Email or Password');
        }
    }
    public function forgetPassword()
    {
        return view('employee::login.password.forget');
    }
    public function emailPassword(Request $request)
    {
        $request->validate(['email'=>'required|email']);

        $data=Employee::where('email',$request->input('email'))->first();

        if($data)
        {
            try {
                    Mail::send(new EmployeePasswordReset($data));
            }
            catch (\Exception $e)
            {
            }

            return redirect()->back()->with('success_message','Password reset link has been sent in email');

        }
        else
        {
            return back()->with('error_message','Email not associated with us');
        }

    }
    public function resetPassword($id)
    {
        $data=Employee::findOrFail($id);
        return view('employee::login.password.reset')->with(compact('data'));
    }
    public function updatePassword(Request $request,$id)
    {
        $request->validate(['password'=>'required|min:8|confirmed']);

        $data=Employee::findOrFail($id);
        if($data->count()>0)
        {
            $data->password=bcrypt($request->input('password'));
            if($data->save())
            {
                return back()->with('success_message','Password reset successful ! Please proceed for login');
            }
            else
            {
                return back()->with('error_message','Error in resetting password');
            }
        }
        else
        {
            return back()->with('error_message','Record not associated with us!');
        }
    }
}
