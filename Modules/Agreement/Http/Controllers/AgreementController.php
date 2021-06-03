<?php

namespace Modules\Agreement\Http\Controllers;

use App\Models\Organization;
use App\Models\Project;
use App\Models\projectCRUD\Project_Partie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Group\Http\Controllers\PermissionController;
use Auth;
use Carbon\Carbon;
use DateTime;

class AgreementController extends Controller
{
    public $permission;

    public function __construct()
    {
        $this->permission = new PermissionController();
    }

    public function index()
    {
        return view('agreement::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status = $this->permission->fetchPermission('Project', 'create');
        if ($status == 1) {
            $permission = $this->permission->showPermission(Auth::id());
            $company_list = Project::select('name')->where('status', 1)->groupBy('name')->get();
            return view('agreement::crud.create')->with(compact('permission', 'company_list'));
        } else {
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

            'name' => 'required',
            'file_number' => 'required|unique:projects',
            'type' => 'required',
            'agtype' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'example_emailBS' => 'required',
            'send_mail'=>'required',
            'party.0.name' => 'required',
            'party.0.email' => 'required|email',
            'party.0.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.0.contact_person_name' => 'required',
            'party.0.contact_person_designation' => 'required',
            'party.0.contact_person_contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'party.0.contact_person_email' => 'required|email',
            'party.*.email' => 'nullable|email',
            'party.*.contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.*.contact_person_contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'party.*.contact_person_email' => 'nullable|email',
        ], [
            'party.*.email.email' => ':input is not valid email',
            'party.*.contact.regex' => ':input is not valid contact number',
            'party.*.contact.min' => 'Given :input less than 9 numbers',
            'party.*.contact_person_contact.min' => 'Given :input less than 10 numbers',
            'party.*.contact_person_contact.regex' => ':input is not valid contact number',
            'party.*.contact_person_email.email' => ':input is not valid email',
            'agtype.required' => 'Agreement Type Required',
            'example_emailBS.required' => 'Reminder email is required',
            'send_mail.required'=>'Reminder email sending day not defined',
            'party.0.name.required' => 'First Party Company Name is required',
            'party.0.email.required' => 'We need to know first party email address',
            'party.0.email.email' => 'First Party invalid email address',
            'party.0.contact.required' => 'We need to know first party contact number',
            'party.0.contact.min' => 'Invalid Contact number provided for First Party',
            'party.0.email.min' => 'Invalid contact number provided to First Party',
            'party.0.contact_person_name.required' => 'Contact Person not given for First Party',
            'party.0.contact_person_designation.required' => 'Contact Person designation not given for First Party',
            'party.0.contact_person_contact.required' => 'Contact Person Phone number not given for First Party',
            'party.0.contact_person_contact.min' => 'Invalid Contact number provided for Contact Person of First Party',
            'party.0.contact_person_email.required' => 'We need to know email address of contact Person of First Party',
            'party.0.contact_person_email.email' => 'Invalid email provided of Contact Person for First Party']);

        $data = new Project();
        $data->name = $request->input('name');
        $data->file_number = $request->input('file_number');
        $data->type = $request->input('type');
        $data->agreement_type = $request->input('agtype');
        $data->start = $request->input('start_date');
        $data->deadline = $request->input('end_date');
        $data->agreement_duration = $request->input('ag_duration');
        $data->duration_type = $request->input('duration_type');
        $data->project_cost = $request->input('project_cost');
        $data->amc = $request->input('amc');
        $data->reminder_email = $request->input('example_emailBS');
        $data->sent_mail_before=$request->input('send_mail');
        $data->organizations_id = Auth::user()->organizations_id;
        $data->department_id=Auth::user()->department_id;
        $data->created_by = Auth::id();
        $data->status = 1;
        if ($data->save()) {
            $org_name = Organization::findOrFail(Auth::user()->organizations_id);

            $path = public_path() . '/uploads/project_files/' . str_replace(' ', '-', $org_name->name) . "/" . str_replace(' ', '-', $request->input('name'));

            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            if ($request->has('party')) {

                $party = $request->party;
                foreach ($party as $parties) {
                    if (($parties['name'] && $parties['email']) != null) {
                        $partiesData = new Project_Partie();
                        $partiesData->projects_id = $data->id;
                        $partiesData->name = $parties['name'];
                        $partiesData->email = $parties['email'];
                        $partiesData->contact = $parties['contact'];
                        $partiesData->contact_person_name = $parties['contact_person_name'];
                        $partiesData->contact_person_designation = $parties['contact_person_designation'];
                        $partiesData->contact_person_contact = $parties['contact_person_contact'];
                        $partiesData->contact_person_email = $parties['contact_person_email'];
                        $partiesData->created_by = Auth::id();
                        $partiesData->save();
                    }
                }
            }
            return redirect()->route('file.upload', ['id' => $data->id])->with('success_message', 'Project Created Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Error in creating project');
        }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id = null)
    {
        $status = $this->permission->fetchPermission('Project', 'view');
        if ($status == 1) {
            if (Auth::user()->type == 0) {
                if ($id == null) {
                    $data = Project::where(['status' => 1])->get();
                } else {
                    $data = Project::where(['status' => 1, 'organizations_id' => $id,'department_id'=>Auth::user()->department_id])->get();
                }
            } else {

                if(Auth::user()->department_id==null) {
                    $data = Project::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id])->get();
                }
                else
                {
                    $data = Project::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id,'department_id'=>Auth::user()->department_id])->get();
                }
            }
            $permission = $this->permission->showPermission(Auth::id());

            $org_data = Organization::where('status', 1)->get();

            return view('agreement::crud.show')->with(compact('data', 'permission', 'org_data'));

        } else {
            abort(404);
        }
    }


    public function projectDetail($id)
    {
        $status = $this->permission->fetchPermission('Project', 'view');
        if ($status == 1) {
            $data = Project::findOrFail($id);
            $permission = $this->permission->showPermission(Auth::id());
            $date_start = new DateTime($data->start);
            $date_end = new DateTime($data->deadline);
            $interval = $date_start->diff($date_end);
            $data->remaining_days = ($interval->format('%a') > 0) ? $interval->format('%a') . ' Days to Expire' : 'Deadline expired';
            $data_reminder = json_decode($data->reminder_email);
            $data->reminder_email = $data_reminder;
            return view('agreement::crud.showDetail')->with(compact('data', 'permission'));
        } else {
            abort(404);
        }

    }

    public function upload(Request $request)
    {
        print_r($request->allFiles());
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status = $this->permission->fetchPermission('Project', 'edit');
        if ($status == 1) {

            $data = Project::findOrFail($id);
            $permission = $this->permission->showPermission(Auth::id());
            return view('agreement::crud.edit')->with(compact('data', 'permission'));
        } else {
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
        $data = Project::findOrFail($id);
        $project_directory = $data->name;

        $request->validate([

            'name' => 'required',
            'file_number'=>'required|unique:projects,file_number,'.$data->id,
            'type' => 'required',
            'agtype' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'example_emailBS' => 'required',
            'send_mail'=>'required',
            'party.0.name' => 'required',
            'party.0.email' => 'required|email',
            'party.0.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.0.contact_person_name' => 'required',
            'party.0.contact_person_designation' => 'required',
            'party.0.contact_person_contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'party.0.contact_person_email' => 'required|email',
            'party.*.email' => 'nullable|email',
            'party.*.contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'party.*.contact_person_contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'party.*.contact_person_email' => 'nullable|email',
        ], [
            'party.*.email.email' => ':input is not valid email',
            'party.*.contact.regex' => ':input is not valid contact number',
            'party.*.contact.min' => 'Given :input less than 9 numbers',
            'party.*.contact_person_contact.min' => 'Given :input less than 10 numbers',
            'party.*.contact_person_contact.regex' => ':input is not valid contact number',
            'party.*.contact_person_email.email' => ':input is not valid email',
            'agtype.required' => 'Agreement Type Required',
            'example_emailBS.required' => 'Reminder email is required',
            'send_mail.required'=>'Reminder email sending day not defined',
            'party.0.name.required' => 'First Party Company Name is required',
            'party.0.email.required' => 'We need to know first party email address',
            'party.0.email.email' => 'First Party invalid email address',
            'party.0.contact.required' => 'We need to know first party contact number',
            'party.0.contact.min' => 'Invalid Contact number provided for First Party',
            'party.0.email.min' => 'Invalid contact number provided to First Party',
            'party.0.contact_person_name.required' => 'Contact Person not given for First Party',
            'party.0.contact_person_designation.required' => 'Contact Person designation not given for First Party',
            'party.0.contact_person_contact.required' => 'Contact Person Phone number not given for First Party',
            'party.0.contact_person_contact.min' => 'Invalid Contact number provided for Contact Person of First Party',
            'party.0.contact_person_email.required' => 'We need to know email address of contact Person of First Party',
            'party.0.contact_person_email.email' => 'Invalid email provided of Contact Person for First Party'
        ]);

        $data->name = $request->input('name');
        $data->file_number=$request->input('file_number');
        $data->type = $request->input('type');
        $data->agreement_type = $request->input('agtype');
        $data->start = $request->input('start_date');
        $data->deadline = $request->input('end_date');
        $data->agreement_duration = $request->input('ag_duration');
        $data->duration_type = $request->input('duration_type');
        $data->project_cost = $request->input('project_cost');
        $data->amc = $request->input('amc');
        $data->reminder_email = $request->input('example_emailBS');
        $data->sent_mail_before=$request->input('send_mail');
        $data->updated_by = Auth::id();
        $new_path = public_path() . '/uploads/project_files/' . str_replace(" ", "-", $data->Organization->name) . '/' . str_replace(' ', '-', $request->input('name'));
        $old_path = public_path() . '/uploads/project_files/' . str_replace(" ", "-", $data->Organization->name) . '/' . str_replace(' ', '-', $project_directory);

        if ($data->save()) {

            rename($old_path, $new_path);

            if ($request->has('party')) {

                $data_Party = Project_Partie::where('projects_id', $data->id)->delete();

                $party = $request->party;

                foreach ($party as $parties) {
                    if (($parties['name'] && $parties['email']) != null) {
                        $partiesData = new Project_Partie();
                        $partiesData->projects_id = $data->id;
                        $partiesData->name = $parties['name'];
                        $partiesData->email = $parties['email'];
                        $partiesData->contact = $parties['contact'];
                        $partiesData->contact_person_name = $parties['contact_person_name'];
                        $partiesData->contact_person_designation = $parties['contact_person_designation'];
                        $partiesData->contact_person_contact = $parties['contact_person_contact'];
                        $partiesData->contact_person_email = $parties['contact_person_email'];
                        $partiesData->created_by = Auth::id();
                        $partiesData->save();
                    }
                }
            }
            return redirect()->back()->with('success_message', 'Project Updated Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Error in updating project');
        }
    }

    public function clientDelete($id)
    {
        $status = $this->permission->fetchPermission('Project', 'edit');
        if ($status == 1) {
            $action = Project_Partie::findOrFail($id)->delete();
            if ($action) {
                return redirect()->back();
            }
        }
    }

    public function generateReport()
    {
        $status = $this->permission->fetchPermission('Project', 'view');
        if ($status == 1) {
            if (Auth::user()->type == 0) {
                $data = Project::where('status', 1)->get();
            } else {
                if(Auth::user()->department_id==null) {
                    $data = Project::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id])->get();
                }
                else
                {
                    $data = Project::where(['status' => 1, 'organizations_id' => Auth::user()->organizations_id,'department_id'=>Auth::user()->department_id])->get();
                }
            }
            $permission = $this->permission->showPermission(Auth::id());
            return view('agreement::crud.report')->with(compact('data', 'permission'));

        }
    }

    public function updateStatus($id)
    {
        $data=Project::findOrFail($id);
        if($data->position==1) {
            $data->position = 0;
        }
        else
        {
            $data->position=1;
        }
        if($data->save())
        {
            return redirect()->back()->with('success_message','Project Status updated');
        }
        else
        {
            return redirect()->back()->with('error_message','Error in updating project status');
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $status=$this->permission->fetchPermission('Project','delete');
        if($status==1)
        {
            $data=Project::findOrFail($id);
            $data->status=0;
            $data->deleted_by = Auth::id();
            $trash = $this->permission->trash('Project', $id);
            if ($trash == 1) {
                if ($data->save()) {
                    return redirect()->route('project.show')->with('success_message', 'Project deleted successfully');
                } else {
                    return redirect()->route('project.show')->with('error_message', 'Error in deleting Project');
                }
            } else {
                return redirect()->route('project.show')->with('error_message', 'Error in deleting Project');
            }
        }
    }
}
