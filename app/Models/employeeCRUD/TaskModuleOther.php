<?php

namespace App\Models\employeeCRUD;

use Illuminate\Database\Eloquent\Model;

class TaskModuleOther extends Model
{
    public $guarded=['id'];
    public $table="task_module_other";

    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class,'daily_task_id','id');
    }
}
