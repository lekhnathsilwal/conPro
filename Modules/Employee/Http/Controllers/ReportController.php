<?php

namespace Modules\Employee\Http\Controllers;

use App\Models\Client;
use App\Models\employeeCRUD\DailyReport;
use App\Models\employeeCRUD\DailyTask;
use App\Models\employeeCRUD\TaskModuleCall;
use App\Models\employeeCRUD\TaskModuleDocumentation;
use App\Models\employeeCRUD\TaskModuleMeeting;
use App\Models\employeeCRUD\TaskModuleOperation;
use App\Models\employeeCRUD\TaskModuleOther;
use App\Models\Organization;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;

class ReportController extends Controller
{

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
            $client=Client::where(['status'=>1,'organizations_id'=>Auth::guard("employee")->user()->organizations_id])->get();
            return view('employee::dashboard.report.create')->with(compact('client'));
    }


    public function store(Request $request)
    {
        $request->validate([
            "task_type"=>"required"
        ]);
        $task_type=$request->input("task_type");

        $request->validate(["client"=>'required']);

        if ($request->input('client')==0) {
            $request->client_name="Other";
        }
        else{
            $client = Client::findOrFail($request->input('client'));
            $request->client_name = $client->company;

        }
        $data=new DailyReport();
        $data->organizations_id=Auth::guard("employee")->user()->organizations_id;
        $data->departments_id=Auth::guard("employee")->user()->department_id;
        $data->employee_id=Auth::guard("employee")->user()->id;
        $data->client_id=$request->input("client");
        $data->date=date("Y-m-d");
        if($data->save()) {

            $daily_task=$this->dailyTask($request, $data->id);

            if($daily_task) {

                if ($task_type == "meeting") {
                    $this->meeting($request,$daily_task);
                }
                if ($task_type == "call") {
                    $this->call($request,$daily_task);
                }
                if ($task_type == "doc") {
                    $this->doc($request,$daily_task);
                }
                if ($task_type == "operation") {
                    $this->operation($request,$daily_task);
                }
                if ($task_type == "other") {

                    $this->other($request,$daily_task);
                }
            }
            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');
        }else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }

    public function dailyTask(Request $request,$id)
    {
        $data=new DailyTask();
        $data->daily_report_id=$id;
        $data->task_nature=$request->input('task_type');
        $data->save();
        return $data->id;
    }

    public function meeting($request,$id)
    {
        $request->validate([

            'venue'=>'required',
            'authorizedPerson'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required|max:12',
            'timeDurationMinute'=>'required|max:60',
            'conclusion'=>'required'
        ]);

        $data=new TaskModuleMeeting();

        $data->venue=$request->venue;
        $data->authorizedPerson=$request->authorizedPerson;
        $data->date_time=$request->taskDateTime;
        $data->client_id=$request->client;
        $data->client_name=$request->client_name;
        $data->duration=$request->timeDurationHour.":".$request->timeDurationMinute;
        $data->daily_task_id=$id;
        $data->task_conclusion=$request->conclusion;
        if($data->save())
        {
            DailyTask::findOrFail($id)->update(['task_module_id'=>$data->id]);

            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');

        }
        else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }
    public function call($request,$id)
    {
        $request->validate([

            'status'=>'required',
            'authorizedPerson'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required|max:12',
            'timeDurationMinute'=>'required|max:60',
            'conclusion'=>'required'
        ]);

        $data=new TaskModuleCall();
        $data->call_status=$request->status;
        $data->authorizedPerson=$request->authorizedPerson;
        $data->date_time=$request->taskDateTime;
        $data->client_id=$request->client;
        $data->client_name=$request->client_name;
        $data->duration=$request->timeDurationHour.":".$request->timeDurationMinute;
        $data->daily_task_id=$id;
        $data->task_conclusion=$request->conclusion;
        if($data->save())
        {
            DailyTask::findOrFail($id)->update(['task_module_id'=>$data->id]);

            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');

        }
        else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }
    public function operation($request,$id)
    {
        $request->validate([

            'operation_type'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required|max:12',
            'timeDurationMinute'=>'required|max:60',
            'conclusion'=>'required'
        ]);

        $data=new TaskModuleOperation();
        $data->task=$request->operation_type;
        $data->date_time=$request->taskDateTime;
        $data->client_id=$request->client;
        $data->client_name=$request->client_name;
        $data->duration=$request->timeDurationHour.":".$request->timeDurationMinute;
        $data->daily_task_id=$id;
        $data->task_conclusion=$request->conclusion;

        if($data->save())
        {
            DailyTask::findOrFail($id)->update(['task_module_id'=>$data->id]);

            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');

        }
        else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }
    public function doc($request,$id)
    {
        $request->validate([

            'doc_type'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required|max:12',
            'timeDurationMinute'=>'required|max:60',
            'conclusion'=>'required'
        ]);

        $data=new TaskModuleDocumentation();
        $data->task=$request->doc_type;
        $data->date_time=$request->taskDateTime;
        $data->client_id=$request->client;
        $data->client_name=$request->client_name;
        $data->duration=$request->timeDurationHour.":".$request->timeDurationMinute;
        $data->daily_task_id=$id;
        $data->task_conclusion=$request->conclusion;

        if($data->save())
        {
            DailyTask::findOrFail($id)->update(['task_module_id'=>$data->id]);
            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');
        }
        else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }
    public function other($request,$id)
    {
        $request->validate([

            'task_title'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required|max:12',
            'timeDurationMinute'=>'required|max:60',
            'conclusion'=>'required'
        ]);

        $data=new TaskModuleOther();
        $data->task=$request->task_title;
        $data->date_time=$request->taskDateTime;
        $data->client_id=$request->client;
        $data->client_name=$request->client_name;
        $data->duration=$request->timeDurationHour.":".$request->timeDurationMinute;
        $data->daily_task_id=$id;
        $data->task_conclusion=$request->conclusion;

        if($data->save())
        {
            DailyTask::findOrFail($id)->update(['task_module_id'=>$data->id]);
            return redirect()->route('report.show')->with('success_message','Daily Report added successfully');
        }
        else{
            return redirect()->route('report.show')->with('error_message','Error in adding daily Report');
        }
    }
    public function show()
    {
        if(Auth::guard('employee')->user()->departments_id==null)
        {
            $data=DailyReport::where(['organizations_id'=>Auth::guard('employee')->user()->organizations_id,'departments_id'=>Auth::guard('employee')->user()->departments_id])->get();
        }
        else {
            $data = DailyReport::where('employee_id', Auth::guard('employee')->user()->id)->get();
        }
        return view('employee::dashboard.report.show')->with(compact('data'));
    }

    public function detail($id)
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
            return view('employee::dashboard.report.detail')->with(compact('data','data_value'));
        }
        else{
            return back()->with('error_message','Invalid Entry ! Please Delete the Entry Manually');
        }
    }


    public function edit($id)
    {
        $client=Client::where('organizations_id',Auth::guard('employee')->user()->organizations_id)->get();

        $data=DailyReport::findOrFail($id);
        $task_nature=$data->dailyTask->task_nature;
        switch ($task_nature)
        {
            case "call":
                $data_value=TaskModuleCall::where('id',$data->dailyTask->task_module_id)->first();
                $data_value->module="call";
                break;
            case "doc":
                $data_value=TaskModuleDocumentation::where('id',$data->dailyTask->task_module_id)->first();
                $data_value->module="doc";
                break;
            case "other":
                $data_value=TaskModuleOther::where('id',$data->dailyTask->task_module_id)->first();
                $data_value->module="other";
                break;
            case "operation":
                $data_value=TaskModuleOperation::where('id',$data->dailyTask->task_module_id)->first();
                $data_value->module="operation";
                break;
            default:
                $data_value=TaskModuleMeeting::where('id',$data->dailyTask->task_module_id)->first();
                $data_value->module="meeting";
                break;
        }
        return view('employee::dashboard.report.edit')->with(compact('data','data_value','client'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module=$request->module;
        switch ($module)
        {
            case "call":
                $rule=['status'=>'required','authorizedPerson'=>'required'];
                $message=['status.required'=>'We need to know about call status! Required',
                    'authorizedPerson.required'=>'We need to know whom did you talked with!'];
                break;
            case "doc":
                $rule=['doc_type'=>'required'];
                $message=['doc_type.required'=>'Please specify document type! Required'];
                break;
            case "other":
                $rule=['task_title'=>'required'];
                $message=['task_title.required'=>'Please specify task title! Required'];
                break;
            case "operation":
                $rule=['operation_type'=>'required'];
                $message=['operation_type.required'=>'Please specify operation type! Required'];
                break;
            default:
                $rule=['venue'=>'required','authorizedPerson'=>'required'];
                $message=['venue.required'=>'Please select or enter venue ! Required',
                    'authorizedPerson.required'=>'We need to know whom did you meet with!'];
                break;
        }
        $additionalRule=[
            'client'=>'required',
            'taskDateTime'=>'required',
            'timeDurationHour'=>'required',
            'timeDurationMinute'=>'required',
            'conclusion'=>'required'
        ];
        $additionalMessage=[
            'taskDateTime.required'=>'Please select proper Date and Time of task done',
            'timeDurationHour'=>'Please specify task execution duration in hour',
            'timeDurationMinute'=>'Please specify task execution duration in minutes',
            'conclusion.required'=>'Please mention task overall conclusion'
        ];
        $rule=array_merge($rule,$additionalRule);
        $message=array_merge($message,$additionalMessage);

        $request->validate($rule,$message);
        if ($request->input('client')!=0) {
            $client_info = Client::findOrFail($request->input('client'));
        }
        DailyReport::findOrFail($id)->update(['client_id'=>$request->input('client')]);

        switch ($module)
        {
            case "call":
                $data_report=TaskModuleCall::findOrFail($request->input('module_value'));
                $data_report->call_status=$request->input('status');
                break;
            case "doc":
                $data_report=TaskModuleDocumentation::findOrFail($request->input('module_value'));
                $data_report->task=$request->input('doc_type');
                break;
            case "other":
                $data_report=TaskModuleOther::findOrFail($request->input('module_value'));
                $data_report->task=$request->input('task_title');
                break;
            case "operation":
                $data_report=TaskModuleOperation::findOrFail($request->input('module_value'));
                $data_report->task=$request->input('operation_type');
                break;
            default:
                $data_report=TaskModuleMeeting::findOrFail($request->input('module_value'));
                $data_report->venue=$request->input('venue');
                break;
        }

        if ($request->input('client')!=0) {
            $data_report->client_name = $client_info->company;
        }
        $data_report->client_name="Other";
        $data_report->duration=$request->input('timeDurationHour').":".$request->input('timeDurationMinute');
        $data_report->authorizedPerson=$request->input('authorizedPerson');
        $data_report->task_conclusion=$request->input('conclusion');
        $data_report->client_id=$request->input('client');
        if($data_report->save())
        {
            return redirect()->route('report.show')->with('success_message','Report Updated Successfully!');
        }
        else
        {
            return back()->with('error_message','Error in updating report!');
        }


    }
    public function destroy($id)
    {
        DailyReport::findOrFail($id)->delete();
        return redirect()->route('report.show')->with('success_message','Report deleted successfully!');
    }
}
