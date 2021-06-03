<?php

namespace App\Models;

use App\Models\employeeCRUD\DailyReport;
use App\Models\User;
use Illuminate\Foundation\Auth\User as UserAuth;

class Employee extends UserAuth
{
    public $guarded=['id'];
    public $table="employee";

    public function organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'departments_id','id');
    }
    public function emp_created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function emp_updated_by()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function emp_deleted_by()
    {
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function dailyReport()
    {
        return $this->hasMany(DailyReport::class,'employee_id','id');
    }

}
