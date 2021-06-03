<?php

namespace Modules\Employee\Http\Controllers;

use App\Mail\EmployeeRegistration;
use App\Models\Department;
use App\Models\Employee;
use App\Models\employeeCRUD\DailyReport;
use App\Models\employeeCRUD\TaskModuleCall;
use App\Models\employeeCRUD\TaskModuleDocumentation;
use App\Models\employeeCRUD\TaskModuleMeeting;
use App\Models\employeeCRUD\TaskModuleOperation;
use App\Models\employeeCRUD\TaskModuleOther;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Group\Http\Controllers\PermissionController;
use Auth;

class EmployeeController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }

    public function index()
    {
        return view('employee::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status=$this->permission->fetchPermission('Employee','create');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $department=Department::where(['organizations_id'=>Auth::user()->organizations_id,'status'=>1])->get();
            return view('employee::crud.create')->with(compact('permission','department'));
        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Access Denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required',
            'email'=>'required|email|unique:employee,email',
            'dob'=>'nullable|date',
            'gender'=>'required',
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'required',
            'department'=>'required',
            'joined'=>'nullable|date',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $data=new Employee();
        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->dob=$request->input('dob');
        $data->gender=$request->input('gender');
        $data->contact=$request->input('contact');
        $data->address=$request->input('address');
        $data->organizations_id=Auth::user()->organizations_id;
        $data->joined_date=$request->input('joined');
        $data->departments_id=($request->input('department')=='all'?NULL:$request->input('department'));
        $password=str_random(10);
        $data->password=bcrypt($password);
        $data->designation=$request->input('designation');
        $data->created_by=Auth::id();
        $image=null;
        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/img/profile-photos';
            $file = $request->file('image');
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            $request->file('image')->move($path, $fileNameToStore);
        }
        $data->image=$image;

        if($data->save())
        {

            $array = ['id' => $data->id, 'name' => $request->input('name'), 'email' => $request->input('email'),
                'password' => $password, 'created_by_name' => Auth::user()->name
            ];

            try {
                Mail::send(new EmployeeRegistration($array));
                return redirect()->route('user.dashboard')->with('success_message','Employee Registered Successfully!');
            }
            catch (Exception $e)
            {
            }
        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Error in employee registration');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $status=$this->permission->fetchPermission('Employee','view');
        if($status==1) {

            if (Auth::user()->type == 0) {
                $data = Employee::where('status', 1)->get();
                $organization=Organization::where('status',1)->get();
            } else {
                if (Auth::user()->department_id == NULL) {
                    $data = Employee::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id])->get();
                } else {
                    $data = Employee::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id, 'department_id' => Auth::user()->department_id])->get();
                }
                $organization=null;
            }
            $permission = $this->permission->showPermission(Auth::id());
            return view('employee::crud.show')->with(compact('data','permission','organization'));
        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Access Denied!');
        }
    }

    public function viewProfile()
    {
        $data=Employee::findOrFail(Auth::guard('employee')->user()->id);
        return view('employee::dashboard.employee.viewProfile')->with(compact('data'));
    }

    public function showDetail($id)
    {
        $status=$this->permission->fetchPermission('Employee','view');
        if($status==1)
        {
            $data=Employee::where(['status'=>1,'id'=>$id])->first();
            $permission=$this->permission->showPermission(Auth::id());
            return view('employee::crud.showDetail')->with(compact('permission','data'));
        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Access Denied!');
        }
    }
    public function showByOrganization($id)
    {
        $status=$this->permission->fetchPermission('Employee','view');
        if($status==1)
        {
            $organization=Organization::where('status',1)->get();
            $data=Employee::where(['status'=>1,'organizations_id'=>$id])->get();
            $permission = $this->permission->showPermission(Auth::id());
            return view('employee::crud.show')->with(compact('data','permission','organization'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status=$this->permission->fetchPermission('Employee','edit');
        if($status==1) {
            $data=Employee::where(['status'=>1,'id'=>$id])->first();
            $permission=$this->permission->showPermission(Auth::id());
            $department=Department::where(['organizations_id'=>Auth::user()->organizations_id,'status'=>1])->get();
            return view('employee::crud.edit')->with(compact('permission','department','data'));

        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Access Denied!');
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
        $data=Employee::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:employee,email,'.$data->id,
            'dob'=>'nullable|date',
            'gender'=>'required',
            'department'=>'required',
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'required',
            'joined'=>'nullable|date',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);


        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->dob=$request->input('dob');
        $data->gender=$request->input('gender');
        $data->contact=$request->input('contact');
        $data->address=$request->input('address');
        $data->joined_date=$request->input('joined');
        $data->departments_id=($request->input('department')=='all'?null:$request->input('department'));
        $data->designation=$request->input('designation');
        $data->updated_by=Auth::id();
        $image=$data->image;
        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/img/profile-photos';
            $file = $request->file('image');
            if($image!=null) {
                unlink($path .'/'. $image);
                }
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            $request->file('image')->move($path, $fileNameToStore);
        }
        $data->image=$image;
        if($data->save()) {

            return redirect()->route('employee.show')->with('success_message', 'Employee Registered Successfully!');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in employee registration');
        }
    }

    public function verify($id)
    {
        $data=Employee::findOrFail($id);
        if($data->verified==0)
        {
            $data->verified=1;
            if($data->save())
            {
                return view("employee::login.verification.index")->with(['success_message'=>'YOUR ACCOUNT IS ACTIVATED ! PROCEED TO LOGIN']);
            }
            else
            {
                return view("employee::login.verification.index")->with(['success_message'=>'ERROR IN ACTIVATING ACCOUNT ! TRY AGAIN LATER']);
            }

        }
        else
        {
            return view("employee::login.verification.index")->with(['success_message'=>'YOUR ACCOUNT IS ALREADY ACTIVATED ! PROCEED TO LOGIN']);
        }

    }

    public function editProfile()
    {
        $data=Employee::findOrFail(Auth::guard('employee')->user()->id);
        return view("employee::dashboard.employee.editProfile")->with(compact('data'));
    }
    public function updateProfile(Request $request)
    {
        $data=Employee::findOrFail(Auth::guard('employee')->user()->id);

        $request->validate([

            'name'=>'required',
            'dob'=>'nullable|date',
            'gender'=>'required',
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data->name=$request->input('name');
        $data->dob=$request->input('dob');
        $data->gender=$request->input('gender');
        $data->contact=$request->input('contact');
        $data->address=$request->input('address');
        $image=$data->image;
        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/img/profile-photos';
            if($image!=null)
            {
                unlink($path."/".$image);
            }
            $file = $request->file('image');
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            $request->file('image')->move($path, $fileNameToStore);
        }
        $data->image=$image;

        if($data->save())
        {
                return redirect()->route('employee.view.profile')->with('success_message','Profile Updated Successfully!');
        }
        else
        {
            return back()->with('error_message','Error in updating profile');
        }
    }

    public function changePassword()
    {
        return view('employee::dashboard.employee.changePassword');
    }
    public function updatePassword(Request $request)
    {
        if(Hash::check($request->get('currentpassword'),Auth::guard('employee')->user()->password))
        {
            $request->validate([
                'currentpassword'=>'required',
                'password'=>'required|confirmed|max:30|min:8'
            ]);

            $data=Employee::findOrFail(Auth::guard('employee')->user()->id);
            $data->password=bcrypt($request->get('password'));
            if($data->save())
            {
                return redirect()->route('employee.logout')->with('success_message','Password updated successfully!Please login to proceed');
            }
            else
            {
                return back()->with('error_message','Error in updating password');
            }
        }
        else
        {
            return redirect()->back()->withErrors(['currentpassword'=>'Old password did not matched']);
        }
    }
    public function showByDepartment($id)
    {
        $data=Employee::where('departments_id',$id)->get();
        $permission=$this->permission->showPermission(Auth::id());
        return view('employee::dashboard.employee.showByDepartment')->with(compact('permission','data'));
    }
    public function showAllReport($id=null)
    {
        if($id!=null)
        {

        }
        else
        {
            if(Auth::user()->type==0) {
                $data = DailyReport::all();
                $data_org=Organization::where('status',1)->get();
            }
            else
            {
                $data=DailyReport::where('organizations_id',Auth::user()->organizations_id)->get();
                $data_org=null;
            }
            $permission=$this->permission->showPermission(Auth::id());
            return view("employee::report.showAll")->with(compact('data','data_org','permission'));
        }
    }
    public function showDetailReport($id)
    {
        $data=DailyReport::findOrFail($id);
        switch ($data->dailyTask->task_nature)
        {
            case "call":
                $data_value=TaskModuleCall::where('id',$data->dailyTask->task_module_id)->first();
                break;
            case "doc":
                $data_value=TaskModuleDocumentation::where('id',$data->dailyTask->task_module_id)->first();
                break;
            case "other":
                $data_value=TaskModuleOther::where('id',$data->dailyTask->task_module_id)->first();
                break;
            case "operation":
                $data_value=TaskModuleOperation::where('id',$data->dailyTask->task_module_id)->first();
                break;
            default:
                $data_value=TaskModuleMeeting::where('id',$data->dailyTask->task_module_id)->first();
                break;
        }
        if ($data_value) {
            $permission = $this->permission->showPermission(Auth::id());
            return view('employee::report.detail')->with(compact('data', 'data_value', 'permission'));
        }
        else{
            return back()->with('error_message','Invalid Entry ! Please Delete the Entry Manually');
        }
    }
    public function delete($id)
    {
        DailyReport::findOrFail($id)->delete();
        return redirect()->route('employee.report.show.all')->with('success_message','Report deleted successfully!');
    }

    public function destroy($id)
    {
        $status=$this->permission->fetchPermission('Employee','delete');
        if($status==1)
        {
            $data=Employee::findOrFail($id);
            $data->status=0;
            $data->deleted_by = Auth::id();
            $trash = $this->permission->trash('Employee', $id);
            if ($trash == 1) {
                if ($data->save()) {
                    return redirect()->route('employee.show')->with('success_message', 'Employee deleted successfully');
                } else {
                    return redirect()->route('employee.show')->with('error_message', 'Error in deleting employee');
                }
            } else {
                return redirect()->route('employee.show')->with('error_message', 'Error in deleting employee');
            }
        }
        else
        {
            return redirect()->route('user.dashboard')->with('error_message','Access Denied!');
        }
    }
}
