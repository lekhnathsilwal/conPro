<?php

namespace App\Models\employeeCRUD;

use App\Models\clientCRUD\ClientDetail;
use Illuminate\Database\Eloquent\Model;

class TaskModuleCall extends Model
{
    public $guarded=['id'];
    public $table="task_module_call";

    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class,'daily_task_id','id');
    }
    public function clientDetail()
    {
        return $this->hasMany(ClientDetail::class,'with_id','id');
    }
}
