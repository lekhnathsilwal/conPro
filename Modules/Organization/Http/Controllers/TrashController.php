<?php

namespace Modules\Organization\Http\Controllers;

use App\Models\Employee;
use App\Models\Organization;
use App\Models\trash;
use App\Models\User;
use App\Models\userCRUD\Module;
use App\Models\userCRUD\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Illuminate\Support\Facades\File;
use Modules\Group\Http\Controllers\PermissionController;


class TrashController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();

    }

    public function index()
    {
        $status=$this->permission->fetchPermission('Trash','edit');
        if($status==1)
        {
            $data=$this->getAllTrashData();
            $permission=$this->permission->showPermission(Auth::id());
            return view('organization::trash.show')->with(compact('data','permission'));
        }
        else
        {
            abort(404);
        }
    }

    public function getAllTrashData($num=10)
    {
        if(Auth::user()->type==0) {
            $data_trash = trash::select('modules')->groupBy('modules')->get();
            $data_trash_record = trash::all();
        }
        else
        {
            $data_trash = trash::select('modules')->where('organizations_id',Auth::user()->organizations_id)->groupBy('modules')->get();
            $data_trash_record = trash::where('organizations_id',Auth::user()->organizations_id)->get();
        }
        $data_trash_all = array();
        $data_trash_org = Organization::where('status', 0)->get();
        if (count($data_trash_org) > 0) {
            $data_trash_all['name'][0] = 'Organization';
            foreach ($data_trash_org as $org_data) {
                $data_trash_all['Organization'][] = [
                    'ID' => $org_data->id,
                    'Name' => $org_data->name,
                    'Email' => $org_data->email,
                    'Deleted at' => $org_data->deleted_at,
                    'Deleted by' => ($org_data->deleted_by!=null)?$org_data->OrganizationDeletedBy->name:'',
                    'user_id'=>$org_data->deleted_by
                ];
            }
        }
        foreach ($data_trash as $trash_record) {
            $data_trash_all['name'][] = $trash_record->Module->name;
        }
            foreach ($data_trash_record as $record) {
                if ($record->Module->name=="User") {
                        $data_module_user = User::where('status', 0)->get();
                        foreach ($data_module_user as $key=>$data_user) {
                            if($record->data_id==$data_user->id) {
                                $data_trash_all['User'][$key] = [
                                    'ID' => $data_user->id,
                                    'Name' => $data_user->name,
                                    'Organization' => $data_user->Organization->name,
                                    'Designation' => $data_user->designation,
                                    'Type' => $data_user->User_Role->Role->group,
                                    'Deleted date' => $record->created_at,
                                    'Deleted by' => ($record->created_by!=null)?$record->trash_created_by->name:'',
                                    'user_id'=>$record->created_by
                                ];
                            }
                        }
                    }

                    if ($record->Module->name == "Group") {
                        $data_module_group = Role::where('status', 0)->get();
                        foreach ($data_module_group as $key=>$data_group) {
                            if($record->data_id==$data_group->id)
                            {
                                $data_trash_all['Group'][$key] = [
                                    'ID' => $data_group->id,
                                    'Title' => $data_group->group,
                                    'Organization' => ($data_group->organizations_id!=null)?$data_group->Organization->name:'Super Admin Created',
                                    'Deleted date' => $record->created_at,
                                    'Deleted by' => ($record->created_by!=null)?$record->trash_created_by->name:'',
                                    'user_id'=>$record->created_by
                                    ];
                            }

                        }
                    }
                if ($record->Module->name == "Employee") {
                    $data_module_Employee = Employee::where('status', 0)->get();
                    foreach ($data_module_Employee as $key=>$data_Employee) {
                        if($record->data_id==$data_Employee->id)
                        {
                            $data_trash_all['Employee'][$key] = [
                                'ID' => $data_Employee->id,
                                'Name' => $data_Employee->name,
                                'Organization' => ($data_Employee->organizations_id!=null)?$data_Employee->Organization->name:'Super Admin Created',
                                'Department' => ($data_Employee->department_id!=null)?$data_Employee->Department->name:'Overall',
                                'Designation'=>$data_Employee->designation,
                                'Deleted date' => $record->created_at,
                                'Deleted by' => ($record->created_by!=null)?$record->trash_created_by->name:'',
                                'user_id'=>$record->created_by
                            ];
                        }

                    }
                }
                }

        return $data_trash_all;
    }



    public function restore_all()
    {
        $status=$this->permission->fetchPermission('Trash','edit');
        if($status==1)
        {
            Organization::where('status',0)->update(['status'=>1]);
            User::where('status',0)->update(['status'=>1]);
            Employee::where('status',0)->update(['status'=>1]);
            Role::where('status',0)->update(['status'=>1]);
            if(trash::truncate()) {
                return redirect()->back()->with('success_message', 'All data restored successfully');
            }

        }
        else
        {
            abort(404);
        }

    }
    public function restore_by_module($module)
    {
        $status=$this->permission->fetchPermission('Trash','edit');

        if($status==1) {

            if($module!='Organization')
            {
                $module_data=Module::where('name',$module)->first();
                trash::where('modules',$module_data->id)->delete();
            }

            if($module=="User")
            {
                User::where('status',0)->update(['status'=>1]);
            }
            if($module=="Organization")
            {
                Organization::where('status',0)->update(['status'=>1]);
            }
            if($module=="Group")
            {
                Role::where('status',0)->update(['status'=>1]);
            }
            if($module=="Employee")
            {
                Employee::where('status',0)->update(['status'=>1]);
            }

            return redirect()->back()->with('success_message',$module." Data Restored Successfully");

        }
        else
        {
            abort(404);
        }


    }
    public function restore_by_module_data($module,$id)
    {
        $status=$this->permission->fetchPermission('Trash','edit');

        if($status==1) {

            if($module!='Organization')
            {
                $module_data=Module::where('name',$module)->first();
                trash::where(['modules'=>$module_data->id,'data_id'=>$id])->delete();
            }

            if($module=="User")
            {
                User::where(['status'=>0,'id'=>$id])->update(['status'=>1]);
            }
            if($module=="Organization")
            {
                Organization::where(['status'=>0,'id'=>$id])->update(['status'=>1]);
            }

            if($module=="Group")
            {
                Role::where(['status'=>0,'id'=>$id])->update(['status'=>1]);
            }
            if($module=="Employee")
            {
                Employee::where(['status'=>0,'id'=>$id])->update(['status'=>1]);
            }

            return redirect()->back()->with('success_message'," Data Restored Successfully");


        }
        else
        {
            abort(404);
        }
    }

    public function delete_all($org_id)
    {
        $status=$this->permission->fetchPermission('Trash','delete');
        if($status==1)
        {
            if($org_id=='NA'){

                $org_data=Organization::where('status',0)->get();
                foreach ($org_data as $organization)
                {
                    $path_organization=public_path().'/uploads/Employee_files/'.str_replace(' ','-',$organization->name);
                    File::deleteDirectory($path_organization);
                    $organization->delete();
                }


                User::where('status',0)->delete();
                Role::where('status', 0)->delete();
                Employee::where('status',0)->delete();
                trash::truncate();
            }
            else {
                User::where(['status' => 0, 'organizations_id' => $org_id])->delete();

                Employee::where(['status' => 0, 'organizations_id' => $org_id])->delete();

                Role::where('status', 0)->where('organizations_id',$org_id)->delete();
            }
                return redirect()->back()->with('success_message', 'All data deleted successfully');


        }
        else
        {
            abort(404);
        }
    }
    public function delete_by_module($module,$org_id)
    {
        $status=$this->permission->fetchPermission('Trash','delete');
        if($status==1)
        {
            if($org_id!='NA') {

                if($module!="Organization") {

                    $module_data = Module::where('name', $module)->first();
                    trash::where(['modules' => $module_data->id, 'organizations_id' => $org_id])->delete();
                }

                if ($module == "User") {
                    User::where('status', 0)->where('organizations_id', $org_id)->delete();
                }

                if ($module == "Employee") {
                    Employee::where('status', 0)->where('organizations_id',$org_id)->delete();
                }
                if ($module == "Group") {
                    Role::where('status', 0)->where('organizations_id', $org_id)->delete();
                }
            }

            else {
                if($module!='Organization') {
                    $module_data = Module::where('name', $module)->first();
                    trash::where(['modules' => $module_data->id])->delete();
                }

                if($module=="Organization")
                {
                    $org_data=Organization::where('status',0)->get();
                    foreach ($org_data as $organization)
                    {
                        $path_organization=public_path().'/uploads/Employee_files/'.str_replace(' ','-',$organization->name);
                        File::deleteDirectory($path_organization);
                        $organization->delete();
                    }
                }

                if ($module == "User") {
                    User::where('status', 0)->delete();
                }
                if ($module == "Employee") {
                    Employee::where('status', 0)->delete();
                }
                if ($module == "Group") {
                    Role::where('status', 0)->delete();
                }

            }
            return redirect()->back()->with('success_message', 'All data deleted successfully');


        }
        else
        {
            abort(404);
        }
    }
    public function delete_data($module,$id)
    {
        $status=$this->permission->fetchPermission('Trash','delete');
        if($status==1)
        {
            if($module=="Organization")
            {
                $org_data = Organization::where('status', 0)->where('id',$id)->first();
                $path_org = public_path() . '/uploads/Employee_files/' . str_replace(' ', '-', $org_data->name);
                File::deleteDirectory($path_org);
                $org_data->delete();

            }else
            {
                $module_data = Module::where('name', $module)->first();
                trash::where(['modules' => $module_data->id,'data_id'=>$id])->delete();

                if($module=="User")
                {
                    User::where('status', 0)->where('id',$id)->delete();
                }
                if($module=="Group")
                {
                    Role::where('status', 0)->where('id',$id)->delete();
                }
                if ($module == "Employee") {
                    Employee::where('status', 0)->where('id',$id)->delete();
                }
            }
            return redirect()->back()->with('success_message',$module.' Data Deleted Permanently');

        }
        else
        {
            abort(404);
        }
    }

}
