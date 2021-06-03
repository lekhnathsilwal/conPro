<?php

namespace App\Models\employeeCRUD;

use App\Models\Client;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    public $guarded=['id'];
    public $table="daily_report";

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }
    public function dailyTask()
    {
        return $this->hasOne(DailyTask::class,'daily_report_id','id');
    }
}
