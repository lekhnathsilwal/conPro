<?php

namespace Modules\User\Http\Controllers;

use App\Models\Organization;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use App\Models\User;
use Modules\Group\Http\Controllers\PermissionController;

class DashboardController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission=new PermissionController();
    }


    public function index()
    {

        $permission=$this->permission->showPermission(Auth::user()->id);
       return view('user::dashboard.index')->with(compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('user::edit');
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
        //
    }
}
