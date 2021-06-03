<?php

namespace Modules\User\Http\Controllers;

use App\Mail\user_registration;
use App\Models\Department;
use App\Models\userCRUD\Role;
use App\Models\userCRUD\User_Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Group\Http\Controllers\GroupController;
use Modules\Group\Http\Controllers\PermissionController;

class UserController extends Controller
{
    private $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }

    public function index()
    {
        return view('user::login.index');
    }

    public function create()
    {
        $status=$this->permission->fetchPermission('User','create');

        if($status==1) {
            if(Auth::user()->type==0) {

                $organization = Organization::where(['status' => 1])->get();
                $department=null;
            }
            else
            {
                $organization = Organization::where(['status' => 1,'id'=>Auth::user()->organizations_id])->get();
                $department=Department::where(['status'=>1,'organizations_id'=>Auth::user()->organizations_id])->get();

            }
            $permission = $this->permission->showPermission(Auth::user()->id);

            $group = Role::where(['status' => 1,'organizations_id'=>Auth::user()->organizations_id])->get();

            return view('user::dashboard.signup.index')->with(compact('organization', 'permission', 'group','department'));
        }
        else
        {
            abort(404);
        }
    }


    public function store(Request $request)
    {
        if(Auth::user()->type==1)
        {
            $rules = [

                'name' => 'required',
                'department'=>'required',
                'email' => 'required|email|unique:users',
                'contact' => 'required|min:9|max:12',
                'role' => 'required',
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
            ];
        }
        else {
            if ($request->has('type')) {
                if ($request->input('type') == 0) {
                    $rules = [

                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'contact' => 'required|min:9|max:12',
                        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
                    ];
                } else {
                    $rules = [

                        'name' => 'required',
                        'department'=>'required',
                        'email' => 'required|email|unique:users',
                        'contact' => 'required|min:9|max:12',
                        'organization' => 'required',
                        'role' => 'required',
                        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'

                    ];
                }
            } else {
                $rules = [

                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'contact' => 'required|min:9|max:12',
                    'type' => 'required',
                    'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'

                ];
            }
        }
        $message=['image.image'=>'File must be image'];



        $request->validate($rules,$message);

        $image=null;

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->designation = $request->input('designation');
        $user->organizations_id = (Auth::user()->type==0)?$request->input('organization'):Auth::user()->organizations_id;
        $user->department_id=(Auth::user()->type==1)?($request->input('department')=='all')?NULL:$request->input('department'):NULL;
        $user->type = (Auth::user()->type==0)?$request->input('type'):1;
        $user->created_by = Auth::user()->id;
        $user->status = 1;
        $password = Str::random(8);
        $user->password = Hash::make($password);

        if ($request->hasFile('image')) {
                $path = public_path() . '/assets/images/user-img';
                $file = $request->file('image');
                $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
                $image = $fileNameToStore;
                $request->file('image')->move($path, $fileNameToStore);
            }
        $user->image=$image;

        if ($user->save()) {

            if ($request->input('type') == 1) {
                $user_role = new User_Role;
                $user_role->roles_id=$request->input('role');
                $user_role->users_id=$user->id;
                $user_role->created_by=Auth::id();
                $user_role->save();
            }

            $data = ['id' => $user->id, 'name' => $request->input('name'), 'email' => $request->input('email'),
                'password' => $password, 'created_by_name' => Auth::user()->name
            ];
            try {
                Mail::send(new user_registration($data));
            }
            catch (Exception $e)
            {
            }

            return redirect()->route('user.dashboard')->with(['success_message' => 'User Register Successfully.Please check User email to active account']);

        } else {
            return redirect()->back()->with(['error_message' => 'Error: Registering User!']);
        }
    }


    public function show($id=null)
    {
        $status=$this->permission->fetchPermission('User','view');
        if($status==1) {

            if(Auth::user()->type==0) {

                if($id!=null)
                {
                    $user = User::where(['status' => 1])->where('organizations_id', $id)->where('id','!=',Auth::id())->paginate(10);
                }
                else {
                    $user = User::where(['status' => 1])->where('id','!=',Auth::id())->paginate(10);
                }
            }
            else
            {
                $user=User::where(['organizations_id'=>Auth::user()->organizations_id,'status'=>1])->where('id','!=',Auth::id())->paginate(10);
            }
            $permission=$this->permission->showPermission(Auth::id());
            $org_data=Organization::where('status',1)->get();
            return view('user::dashboard.user.show')->with(compact('user','permission','org_data'));
        }
        else
        {
            abort(404);
        }

    }

    public function verify($id)
    {
        $user=User::find($id);

        if($user)
        {
            $user->verified=1;
            $user->save();
            return view('user::login.verification.index')->with(compact('user'));
        }
        else
        {
            return redirect()->route('user.unverified')->with('message','una');
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status=$this->permission->fetchPermission('User','edit');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $data=User::where(['id'=>$id,'status'=>1])->first();
            if(Auth::user()->type==0) {
                $organization = Organization::where(['status' => 1])->get();
                $department=null;
                $group=Role::where('status',1)->get();
            }
            else
            {
                $organization = Organization::where(['status' => 1,'id'=>Auth::user()->organizations_id])->get();
                $department=Department::where(['status'=>1,'organizations_id'=>Auth::user()->organizations_id])->get();
                $group = Role::where(['status' => 1,'organizations_id'=>Auth::user()->organizations_id])->get();
            }

            return view('user::dashboard.user.edit')->with(compact('permission','data','organization','group','department'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if(Auth::user()->type==1)
        {
            $rules = [

                'name' => 'required',
                'department'=>'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'contact' => 'required|min:9|max:12',
                'role' => 'required',
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
            ];
        }
        else {
            if ($request->has('type')) {
                if ($request->input('type') == 0) {
                    $rules = [

                        'name' => 'required',
                        'email' => 'required|email|unique:users,email,'.$user->id,
                        'contact' => 'required|min:9|max:12',
                        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
                    ];
                } else {
                    $rules = [

                        'name' => 'required',
                        'department'=>'required',
                        'email' => 'required|email|unique:users,email,'.$user->id,
                        'contact' => 'required|min:9|max:12',
                        'organization' => 'required',
                        'role' => 'required',
                        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'

                    ];
                }
            } else {
                $rules = [

                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'contact' => 'required|min:9|max:12',
                    'type' => 'required',
                    'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'

                ];
            }
        }
        $message=['image.image'=>'File must be image'];



        $request->validate($rules,$message);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->designation = $request->input('designation');
        $user->organizations_id = (Auth::user()->type==0)?($request->input('type')==0)?null:$request->input('organization'):Auth::user()->organizations_id;
        $user->department_id=(Auth::user()->type==1)?($request->input('department')=='all')?NULL:$request->input('department'):NULL;
        $user->type = (Auth::user()->type==0)?$request->input('type'):1;
        $user->updated_by = Auth::user()->id;
        $image=$user->image;

        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/images/user-img';
            if($user->image!=null)
            {
                unlink($path.'/'.$user->image);
            }
            $file = $request->file('image');
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            $request->file('image')->move($path, $fileNameToStore);
        }
        $user->image=$image;

        if ($user->save()) {

            if ($request->input('type') == 1) {
                $user->User_Role->delete();
                $user_role = new User_Role;
                $user_role->roles_id=$request->input('role');
                $user_role->users_id=$user->id;
                $user_role->created_by=Auth::id();
                $user_role->save();
            }

            return redirect()->route('user.show')->with(['success_message' => 'User data updated Successfully']);

        } else {
            return redirect()->back()->with(['error_message' => 'Error: Updating User data!']);
        }
    }

   public function changePassword()
   {
       $permission=$this->permission->showPermission(Auth::id());
       return view('user::dashboard.user.changePassword')->with(compact('permission'));
   }
   public function updatePassword(Request $request)
   {

       if(Hash::check($request->get('currentpassword'),Auth::user()->password))
       {
           $request->validate([

               'currentpassword'=>'required',
               'password'=>'required|confirmed|max:30|min:8'
           ]);

           $user=User::findOrFail(Auth::id());
           $user->password=bcrypt($request->get('password'));
           if($user->save())
           {
               return redirect()->route('user.logout')->with('success_message','Password updated successfully!Please login to proceed');
           }
       }
       else
       {
           return redirect()->back()->withErrors(['currentpassword'=>'Old password did not matched']);
       }
   }

   public function userDetail($id)
   {
       $status=$this->permission->fetchPermission('User','view');
       if($status==1) {
           $data = User::where(['id'=>$id,'status'=>1])->first();
           $permission = $this->permission->showPermission(Auth::id());
           return view('user::dashboard.user.showDetail')->with(compact('permission', 'data'));
       }
       else
       {
           abort(404);
       }

   }
   public function editProfile()
   {
       $permission=$this->permission->showPermission(Auth::id());
       $data=User::findOrFail(Auth::id());
       return view('user::dashboard.user.editProfile')->with(compact('permission','data'));
   }
   public function updateProfile(Request $request)
   {
       $request->validate([
           'name'=>'required',
           'contact'=>'required|min:8|max:12',
           'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
          ]);

       $user=User::findOrFail(Auth::id());

       $user->name = $request->input('name');
       $user->contact = $request->input('contact');
       $image=$user->image;

       if ($request->hasFile('image')) {
           $path = public_path() . '/assets/images/user-img';
           if($user->image!=null)
           {
               unlink($path.'/'.$user->image);
           }
           $file = $request->file('image');
           $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
           $image = $fileNameToStore;
           $request->file('image')->move($path, $fileNameToStore);
       }
       $user->image=$image;

       if ($user->save()) {

           return redirect()->back()->with('success_message','Profile Updated Successfully');

       }
       else
       {
           return redirect()->back()->withErrors('Error in updating profile!');
       }
   }

   public function showByDepartment($id)
   {
        $data=Department::findOrFail($id);
        $permission=$this->permission->showPermission(Auth::id());
        return view('user::dashboard.user.showByDepartment')->with(compact('permission','data'));
   }

    public function destroy($id)
    {
        $status=$this->permission->fetchPermission('User','delete');

        if ($status==1)
        {
            $data=User::findOrFail($id);
            $data->status=0;
            $data->deleted_by=Auth::id();
            $trash=$this->permission->trash('User',$id);
            if($trash==1)
            {
                if($data->save())
                {
                    return redirect()->route('user.show')->with('success_message','User deleted successfully');
                }
                else
                {
                    return redirect()->route('user.show')->with('error_message','Error in deleting User');
                }
            }
            else
            {
                return redirect()->route('user.show')->with('error_message','Error in deleting User');
            }
        }

    }
}
