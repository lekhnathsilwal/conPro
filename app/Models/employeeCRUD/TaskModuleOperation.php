<?php

namespace App\Models\employeeCRUD;

use App\Models\clientCRUD\ClientDetail;
use Illuminate\Database\Eloquent\Model;

class TaskModuleOperation extends Model
{
    public $guarded=['id'];
    public $table="task_module_operation";

    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class,'daily_task_id','id');
    }
}
