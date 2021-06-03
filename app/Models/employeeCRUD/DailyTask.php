<?php

namespace App\Models\employeeCRUD;

use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    public $guarded=['id'];
    public $table="daily_task";

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class,'daily_report_id','id');
    }
    public function taskModuleMeeting()
    {
        return $this->hasMany(TaskModuleMeeting::class,'daily_task_id','id');
    }
    public function taskModuleCall()
    {
        return $this->hasMany(TaskModuleCall::class,'daily_task_id','id');
    }
    public function taskModuleOperation()
    {
        return $this->hasMany(TaskModuleOperation::class,'daily_task_id','id');
    }
    public function taskModuleDocumentation()
    {
        return $this->hasMany(TaskModuleDocumentation::class,'daily_task_id','id');
    }
    public function taskModuleOther()
    {
        return $this->hasMany(TaskModuleOther::class,'daily_task_id','id');
    }

}
