<?php

namespace Modules\User\Http\Controllers;

use App\Mail\forget_password;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use Auth;
use Mail;
use Illuminate\Support\Facades\Crypt;

class UserLoginController extends Controller
{

    public function login(Request $request)
    {
        $request->validate(['email'=>'required','password'=>'required']);

        $remember=$request->get('remember')==true  ?   true   :   false;
        $email=$request->get('email');

        if(Auth::attempt(['email'=>$email,'password'=>$request->get('password'),'status'=>1],$remember))
        {
            if(Auth::user()->verified==0)
            {
                Auth::logout();
                return redirect()->route('user.home')->with('error_message','Account deactivated ! Please active your account by verifying email');
            }
            else {
                return redirect()->intended(route('user.dashboard'));
            }
        }
        else
        {
            return redirect()->back()->with('error_message','Invalid Email or Password');
        }
    }
    public function forgetPassword()
    {
        return view('user::login.password.forget');
    }

    public function sentPasswordLink(Request $request)
    {

        $request->validate(['email'=>'required|email']);

        $data_user=User::where(['email'=>$request->input('email')])->first();
        if ($data_user) {
            $data = array('name' => $data_user->name, 'email' => $data_user->email, 'id' => $data_user->id);
            try {

                Mail::send(new forget_password($data));

            } catch (Exception $e) {
            }
            return back()->with('success_message', 'Mail has been sent to provided email address');
        }
        else
        {
            return back()->with('error_message','Email is not associated with us!!');
        }

    }
    public function resetPassword($id)
    {
        $data=User::findOrFail($id);
        return view('user::login.password.reset')->with(compact('data'));
    }
    public function updatePassword(Request $request,$id)
    {
        $request->validate([
            'password'=>'required|confirmed|min:8'
        ]);

        $data=User::findOrFail($id);
        $data->password=bcrypt($request->input('password'));
        $data->save();
        return back()->with('success_message','Password reset successful! Process for login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.home');
    }


}
