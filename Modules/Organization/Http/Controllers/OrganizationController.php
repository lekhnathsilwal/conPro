<?php

namespace Modules\Organization\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Group\Http\Controllers\PermissionController;
use Auth;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }

    public function index()
    {
        return view('organization::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status=$this->permission->fetchPermission('Organization','create');
        if($status==1)
        {
            return view('organization::crud.create');
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
        $request->validate([

            'name'=>'required|unique:organizations,name',
            'email'=>'required|unique:organizations,email',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $image=null;
        $organization=new Organization();
        $organization->name=$request->input('name');
        $organization->email=$request->input('email');
        $organization->created_by=Auth::id();

        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/images/org-logo';
            $file = $request->file('image');
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            $request->file('image')->move($path, $fileNameToStore);
        }
        $organization->image=$image;
        if($organization->save())
        {
            $path = public_path().'/uploads/project_files/'.str_replace(' ','-',$request->input('name'));
            if(File::exists($path))
            {
                File::deleteDirectory($path);
                File::makeDirectory($path);
            }
            else {
                File::makeDirectory($path);
            }


            return redirect()->route('organization.show')->with('success_message','Organization registered successfully');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in registering organization');
        }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $status=$this->permission->fetchPermission('organization','view');
        if($status==1)
        {
            $organization=Organization::where('status',1)->paginate(10);
            return view('organization::crud.show')->with(compact('organization'));
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
        $status=$this->permission->fetchPermission('organization','edit');
        if($status==1) {
            $data = Organization::findOrFail($id);
            $permission=$this->permission->showPermission(Auth::id());
            return view('organization::crud.edit')->with(compact('data','permission'));
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
        $data=Organization::findOrFail($id);

        $data_directory=$data->name;

        $request->validate([

            'name'=>'required|unique:organizations,name,'.$data->id,
            'email'=>'required|unique:organizations,email,'.$data->id,
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $data->name=$request->input('name');
        $image=($data->image!=null)?$data->image:null;
        $data->email=$request->input('email');
        $data->updated_by=Auth::id();

        if ($request->hasFile('image')) {
            $path = public_path() . '/assets/images/org-logo';
            $file = $request->file('image');
            $fileNameToStore = date("Y_m_d_H_i_s") . "_" . $file->getClientOriginalName();
            $image = $fileNameToStore;
            if($request->file('image')->move($path, $fileNameToStore))
            {
                if($data->image!=null) {
                    unlink(public_path() . '/assets/images/org-logo/' . $data->image);
                }
            }
            else
            {
                return redirect()->back()->with('error_message','Error in updating organization');
            }

        }
        $data->image=$image;

        $new_path = public_path().'/uploads/project_files/'.str_replace(' ','-',$request->input('name'));
        $old_path=public_path().'/uploads/project_files/'.str_replace(' ','-',$data_directory);
        if($data->save())
        {
            rename($old_path,$new_path);

            return redirect()->route('organization.show')->with('success_message','Organization updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in updating organization');
        }


    }

    public function getDepartment($id)
    {
        $data=Department::where('organizations_id',$id)->get();
        return \response()->json(['data'=>$data],200);
    }
    public function destroy($id)
    {
        $status=$this->permission->fetchPermission('organization','delete');
        if($status==1)
        {
            $data=Organization::findOrFail($id);
            $data->status=0;
            $data->deleted_by=Auth::id();
            //$data->deleted_at=Carbon::now();
            if($data->save())
            {
                $users=User::where('organizations_id',$data->id)->get();
                foreach($users as $user)
                {
                    $this->permission->trash('User', $user->id);
                    $user->status=0;
                    $user->save();
                }


                return redirect()->back()->with('success_message','Organization deleted successfully');
            }
            else
            {
                return redirect()->back()->with('error_message','Error in deletion organization');
            }
        }
    }
}
