<?php

namespace Modules\Group\Http\Controllers;

use App\Models\trash;
use App\Models\User;
use App\Models\userCRUD\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;

class PermissionController extends Controller
{
    public function showPermission($id)
    {
        $data=array();
        if(Auth::user()->type!=0) {
            $userinfo = User::find($id);
            if ($userinfo->status == 1) {
                $role_user = $userinfo->User_Role;

                if ($role_user->role->status == 1) {

                    $data[0]['group'] = $role_user->role->group;
                    $role_per = $role_user->role->Role_Permission;

                    foreach ($role_per as $i => $per) {
                        if ($per->Permission->count() > 0) {

                            $module = $per->Permission->Module;
                            $module_name=str_replace(' ','',$module->name);
                            $data[0]['module']['name'][$i] = $module_name;

                            $data[0]['module'][$module_name] = array(

                                'create' => $per->Permission->create,
                                'view' => $per->Permission->view,
                                'edit' => $per->Permission->edit,
                                'delete' => $per->Permission->delete
                            );
                        }
                    }
                }
            }
        }

        return $data;

    }

    public function fetchPermission($module,$task)
    {
        $permission=$this->showPermission(Auth::id());
        if(Auth::user()->type==0) { $status=1;  } else {
            $status = array_key_exists($module,$permission[0]['module']) ? $permission[0]['module'][''.$module.''][''.$task.''] : 0;
        }
        return $status;

    }

    public function trash($module,$data_id)
    {
        $data=new trash();
        $moduleData=Module::where('name',$module)->first();
        $data->modules=$moduleData->id;
        $data->data_id=$data_id;
        $data->created_by=Auth::id();
        $data->organizations_id=Auth::user()->organizations_id;
        if($data->save())
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }


}
