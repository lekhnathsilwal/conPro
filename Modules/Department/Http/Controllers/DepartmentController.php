<?php

namespace Modules\Department\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Group\Http\Controllers\PermissionController;
use Auth;

class DepartmentController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }

    public function index()
    {
        return view('department::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status=$this->permission->fetchPermission('Department','create');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());

            return view('department::crud.create')->with(compact('permission'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        $org_id=Auth::user()->organizations_id;
        $data=Department::where(['status'=>1,'organizations_id'=>Auth::user()->organizations_id])->get();
        $name=$request->input('name');
        if(count($data)>0)
        {
            foreach ($data as $department)
            {
                if($name==$department->name)
                {
                    return redirect()->back()->with('error_message','Department already exist in Database!');
                }
            }
        }

        $new_data=new Department();
        $new_data->name=$name;
        $new_data->organizations_id=Auth::user()->organizations_id;
        $new_data->created_by=Auth::id();
        if($new_data->save())
        {
            return redirect()->route('department.show')->with('success_message','Department Registered Success');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in Registering Department');
        }




    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $status=$this->permission->fetchPermission('Department','view');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $data=Department::where(['status'=>1,'organizations_id'=>Auth::user()->organizations_id])->get();
            return view('department::crud.show')->with(compact('permission','data'));
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
        $status=$this->permission->fetchPermission('Department','edit');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $data=Department::findOrFail($id);
            return view('department::crud.edit')->with(compact('permission','data'));
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
        $data=Department::where(['status'=>1,'organizations_id'=>Auth::user()->organizations_id])->where('id','!=',$id)->get();
        $name=$request->input('name');
        if(count($data)>0)
        {
            foreach ($data as $department)
            {
                if($name==$department->name)
                {
                    return redirect()->back()->with('error_message','Department already exist in Database!');
                }
            }
        }
        $updated_data=Department::findOrFail($id);
        $updated_data->name=$name;
        if($updated_data->save())
        {
            return redirect()->route('department.show')->with('success_message','Department updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in updating Department');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
