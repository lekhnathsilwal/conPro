<?php

namespace App\Models;

use App\Models\userCRUD\Role;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='department';
    protected $guarded=['id'];

    public function Organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function DepartmentCreatedby()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function DepartmentUpdatedby()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function User()
    {
        return $this->hasMany(User::class,'department_id','id');
    }

}
