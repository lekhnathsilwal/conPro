<?php

namespace Modules\Client\Http\Controllers;

use App\Models\Client;
use App\Models\clientCRUD\ClientDetail;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Illuminate\Support\Facades\File;
use Modules\Group\Http\Controllers\PermissionController;

class ClientController extends Controller
{

    public $permission;
    public function __construct()
    {
        $this->permission=new PermissionController();
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status=$this->permission->fetchPermission('Client','create');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            return view('client::crud.create')->with(compact('permission'));
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

            'company' => 'required',
            'email'=>'email|required',
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',

            'party.0.name' => 'required',
            'party.0.email' => 'required|email',
            'party.0.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.0.designation' => 'required',
            'party.*.email' => 'nullable|email',
            'party.*.contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',

        ], [
            'party.*.email.email' => ':input is not valid email',
            'party.*.contact.regex' => ':input is not valid contact number',
            'party.*.contact.min' => 'Given :input less than 9 numbers',
            'party.0.name.required' => 'First Contact Person Name is required',
            'party.0.email.required' => 'We need to know first contact person email address',
            'party.0.email.email' => 'First Contact Person email invalid given',
            'party.0.contact.required' => 'We need to know first contact person phone number',
            'party.0.contact.min' => 'Invalid Contact number provided for First Contact Person',
            'party.0.designation.required' => 'Designation not given for First Contact Person',
            ]);

        $data = new Client();
        $data->company = $request->input('company');
        $data->email = $request->input('email');
        $data->location = $request->input('location');
        $data->contact = $request->input('contact');
        $data->organizations_id = Auth::user()->organizations_id;
        $data->created_by = Auth::id();
        $data->status = 1;
        if ($data->save()) {

            if ($request->has('party')) {

                $party = $request->party;

                foreach ($party as $parties) {
                    if (($parties['name'] && $parties['email']) != null) {
                        $partiesData = new ClientDetail();
                        $partiesData->clients_id=$data->id;
                        $partiesData->authorized_person = $parties['name'];
                        $partiesData->email = $parties['email'];
                        $partiesData->contact = $parties['contact'];
                        $partiesData->designation = $parties['designation'];
                        $partiesData->save();
                    }
                }
            }
            return redirect()->route('client.show')->with('success_message', 'Client Registered Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Error in registering client');
        }
    }

    public function show()
    {
        $status=$this->permission->fetchPermission('Client','view');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $data=Client::where('status',1)->get();
            return view('client::crud.show')->with(compact('data','permission'));
        }
        else
        {
            abort(404);
        }
    }
    public function showDetail($id)
    {
        $status=$this->permission->fetchPermission('Client','view');
        if($status==1)
        {
            $permission=$this->permission->showPermission(Auth::id());
            $data=Client::where('id',$id)->first();
            return view('client::crud.detail')->with(compact('permission','data'));
        }
        else
        {
            abort(404);
        }
    }

    public function detail($id)
    {
        if(Auth::guard('employee')->check())
        {
            $data=Client::where(['status'=>1,'id'=>$id])->first();
            $data->clientDetail;
            return response()->json(['data'=>$data],200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status=$this->permission->fetchPermission('Client','edit');
        if($status==1) {
            $permission=$this->permission->showPermission(Auth::id());
            $data=Client::where(['status'=>1,'id'=>$id])->first();
            return view('client::crud.edit')->with(compact('data','permission'));
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
        $data=Client::findOrFail($id);

        $request->validate([

            'company' => 'required',
            'email'=>'email|required',
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',

            'party.0.name' => 'required',
            'party.0.email' => 'required|email',
            'party.0.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.0.designation' => 'required',
            'party.*.email' => 'nullable|email',
            'party.*.contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',

        ], [
            'party.*.email.email' => ':input is not valid email',
            'party.*.contact.regex' => ':input is not valid contact number',
            'party.*.contact.min' => 'Given :input less than 9 numbers',
            'party.0.name.required' => 'First Contact Person Name is required',
            'party.0.email.required' => 'We need to know first contact person email address',
            'party.0.email.email' => 'First Contact Person email invalid given',
            'party.0.contact.required' => 'We need to know first contact person phone number',
            'party.0.contact.min' => 'Invalid Contact number provided for First Contact Person',
            'party.0.designation.required' => 'Designation not given for First Contact Person',
        ]);

        $data->company = $request->input('company');
        $data->email = $request->input('email');
        $data->location = $request->input('location');
        $data->contact = $request->input('contact');
        $data->updated_by = Auth::id();
        if ($data->save()) {

            if ($request->has('party')) {

                ClientDetail::where('clients_id',$data->id)->delete();

                $party = $request->party;

                foreach ($party as $parties) {
                    if (($parties['name'] && $parties['email']) != null) {
                        $partiesData = new ClientDetail();
                        $partiesData->clients_id=$data->id;
                        $partiesData->authorized_person = $parties['name'];
                        $partiesData->email = $parties['email'];
                        $partiesData->contact = $parties['contact'];
                        $partiesData->designation = $parties['designation'];
                        $partiesData->save();
                    }
                }
            }
            return redirect()->route('client.show')->with('success_message', 'Client Updated Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Error in updating client information');
        }
    }

   public function detailRemove($id)
   {
       ClientDetail::findOrFail($id)->delete();
       return back()->with('success_message','Client Contact Information Deleted Successfully');
   }
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->route('client.show')->with('success_message','Client Deleted Successfully');
    }
}
