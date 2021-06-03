<?php

namespace Modules\Agreement\Http\Controllers;

use App\Models\Project;
use App\Models\projectCRUD\Project_File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Group\Http\Controllers\PermissionController;
use Auth;

class FileController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }


    public function index()
    {
        return view('agreement::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $status=$this->permission->fetchPermission('Project','create');
        if($status==1) {

            $permission=$this->permission->showPermission(Auth::id());
            $data=Project::where(['status'=>1,'id'=>$id])->first();
            return view('agreement::file.create')->with(compact('permission','data'));
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
    public function store(Request $request,$id)
    {
        $request->validate([
            'file' => 'required',
            'file.*'=>'max:500'
        ],['file.*.max'=>'Uploaded file size is greater than 500KB']);

        $data=Project::findOrFail($id);
        $organization=$data->Organization->name;
        $path=public_path()."/uploads/project_files/".str_replace(' ','-',$organization)."/".str_replace(' ','-',$data->name)."/";

        $org_name=explode(' ',$organization);
        $project_name=explode(' ',$data->name);

        if($request->hasFile('file')){

            for($i=0;$i<count($request->file('file'));$i++)
            {
                $att=new Project_File();

                $att->projects_id = $data->id;
                $file=$request->file('file')[$i];
                $fileNameToStore = $org_name[0]."_".$project_name[0]."-".str_random(8).$file->getClientOriginalName();
                $att->file_name= $fileNameToStore;
                $att->file_ext = $file->getClientOriginalExtension();
                $att->file_size = ceil($file->getSize()/1024);
                $att->created_by=Auth::id();
                if($att->file_size>500)
                {
                    return redirect()->back()->with('error_message','File size in greater than 500 KB');
                }
                $request->file('file')[$i]->move($path, $fileNameToStore);
                $att->save();

            }

        }

        return redirect()->back()->with('success_message','Files Uploaded Successfully');
    }

    public function download($id)
    {
        $data=Project_File::findOrFail($id);

        $organization=str_replace(' ','-',$data->Project->Organization->name);

        $project=str_replace(' ','-',$data->Project->name);


        $path= public_path(). "/uploads/project_files/".$organization."/".$project."/";

        $headers = array(
            'Content-Type: '.$data->file_type.'',
        );

        return response()->download($path.$data->file_name);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('agreement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $status=$this->permission->fetchPermission('Project','edit');
        if($status==1)
        {
            $data=Project_File::findOrFail($id);
            $project=$data->Project->name;
            $organization=$data->Project->Organization->name;
            $path=public_path()."/uploads/project_files/".str_replace(' ','-',$organization)."/".str_replace(' ','-',$project)."/".$data->file_name;
            if(unlink($path))
            {
                $data->delete();
                return redirect()->back()->with('success_message','File Deleted Successfully');
            }
            else
            {
                return redirect()->back()->with('error_message','Error in deleting file! Please try again');
            }
        }
   }
}
