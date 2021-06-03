<?php

namespace Modules\Group\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\userCRUD\Module;
use App\Models\userCRUD\Permission;
use App\Models\userCRUD\Role_Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Http\Controllers\DashboardController;
use Auth;
use App\Models\userCRUD\Role;
use mysql_xdevapi\Exception;


class GroupController extends Controller
{

    private $permission;
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->permission=new PermissionController();

    }

    public function index()
    {
        return view('group::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status=$this->permission->fetchPermission('Group','create');

        if( $status==1) {
            $permission = $this->permission->showPermission(Auth::id());
            $modules = Module::where(['status' => 1])->get();

            return view('group::crud.create')->with(compact('permission', 'modules'));
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
           'name'=>'required',
           'permission'=>'required'
       ],['name.required'=>'User Group is Required']);

       $groupData=Role::where('organizations_id',Auth::user()->organizations_id)->get();

       foreach ($groupData as $data) {
           if ($data->group == $request->input('name')) {
               return redirect()->back()->with('error_message', 'Group name already exist');
           }
       }

        $group=new Role();
        $group->group=$request->input('name');
        $group->organizations_id=(Auth::user()->type==1)?Auth::user()->organizations_id:null;
        $group->created_by=Auth::id();
        if($group->save())
        {
            $roles_id=$group->id;
            $create_permission=$this->createPermission($request,$roles_id);
            if($create_permission) {
                return redirect()->route('group.show')->with(['success_message' => 'Group added successfully']);
            }
        }


    }

    public function createPermission(Request $request,$roles_id)
    {
        if(array_key_exists('permission',$request->all()))
        {
            $permission=$request->permission;

            foreach ($permission as $module_name=>$modulePermission)
            {
                $module=Module::where(['name'=>$module_name])->firstOrFail();

                $create=0;$view=0;$edit=0;$delete=0;
                if(array_key_exists('c',$modulePermission))
                {
                    $create=$modulePermission['c'];
                }
                if(array_key_exists('v',$modulePermission))
                {
                    $view=$modulePermission['v'];
                }
                if(array_key_exists('e',$modulePermission))
                {
                    $edit=$modulePermission['e'];
                }
                if(array_key_exists('d',$modulePermission))
                {
                    $delete=$modulePermission['d'];
                }

                $data=new Permission();
                $data->create=$create;
                $data->view=$view;
                $data->edit=$edit;
                $data->delete=$delete;
                $data->modules_id=$module->id;
                $data->created_by=Auth::id();
                if($data->save())
                {
                    $roles_permission=new Role_Permission();
                    $roles_permission->roles_id=$roles_id;
                    $roles_permission->permissions_id=$data->id;
                    $roles_permission->created_by=Auth::id();
                    $roles_permission->save();
                }


            }

        }
        return true;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $status=$this->permission->fetchPermission('Group','view');

        if( $status==1) {

            if(Auth::user()->type==0) {
                $group = Role::where('organizations_id',NULL)->where('status',1)->paginate(10);
            }
            else
            {
                $group=Role::where('organizations_id',Auth::user()->organizations_id)->where('status',1)->paginate(10);
            }
            $permission=$this->permission->showPermission(Auth::id());
            return view('group::crud.show')->with(compact('group', 'permission'));
        }
        else
        {
            abort(404);
        }
    }

    public function showActive()
    {
        $group=Role::where('status',1)->get();
        return $group;
    }


    public function getPermissionbyRole($id)
    {
        $data=array();
        $role=Role::findOrFail($id);
        $permission=$role->Role_Permission;
        foreach ($permission as $permissionData)
        {
            $permissionObject=$permissionData->Permission;
            $module=$permissionObject->Module->name;
            $data['module'][]=$module;

            $data[$module]=array(

                'create'=>$permissionObject->create,
                'view'=>$permissionObject->view,
                'edit'=>$permissionObject->edit,
                'delete'=>$permissionObject->delete

            );

        }
        return $data;

    }
    public function showPermission($id)
    {
        $permissionuser=$this->permission->showPermission(Auth::id());
        $data=$this->getPermissionbyRole($id);
        return view('group::permission.show')->with(['data'=>$data,'permission'=>$permissionuser]);

    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status=$this->permission->fetchPermission('Group','edit');

        if( $status==1) {

            $group = Role::findOrFail($id);
            $permission=$this->permission->showPermission(Auth::id());
            $data=$this->getPermissionbyRole($id);
            $modules = Module::where(['status' => 1])->get();
            return view('group::crud.edit')->with(compact('group','permission','data','modules'));
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
        try {
            $request->validate([
                'name'=>'required'
            ],['name.required'=>'User Group is Required']);

            $groupData=Role::where(['organizations_id'=>Auth::user()->organizations_id])->where('id','!=',$id)->get();

            foreach ($groupData as $data) {
                if ($data->group == $request->input('name')) {
                    return redirect()->back()->with('error_message', 'Group name already exist');
                }
            }
            $role=Role::findOrFail($id);

            $role->group=$request->input('name');

            if($role->save())
            {
                $role->Role_Permission()->delete();
                $permission=$this->createPermission($request,$id);
                if($permission)
                {
                    return redirect()->route('group.show')->with('success_message','Group updated successfully');
                }
                else
                {
                    return redirect()->back()->with('error_message','Error in updating Group');
                }

            }
            else
            {
                return redirect()->back()->with('error_message','Error in updating data:Duplicate Entry');
            }

        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error_message','Error in updating data:Duplicate Entry');
        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $status = $this->permission->fetchPermission('Group', 'delete');

        if ($status == 1) {
            $data = Role::findOrFail($id);
            $data->status = 0;
            $data->deleted_by = Auth::id();
            $trash = $this->permission->trash('Group', $id);
            if ($trash == 1) {
                if ($data->save()) {
                    return redirect()->route('group.show')->with('success_message', 'Group deleted successfully');
                } else {
                    return redirect()->route('group.show')->with('error_message', 'Error in deleting Group');
                }
            } else {
                return redirect()->route('group.show')->with('error_message', 'Error in deleting Group');
            }
        }
    }
}
