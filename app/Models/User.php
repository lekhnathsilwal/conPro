<?php

namespace App\Models;

use App\Models\userCRUD\Module;
use App\Models\userCRUD\Permission;
use App\Models\Organization;
use App\Models\userCRUD\Role;
use App\Models\userCRUD\User_Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as UserAuth;



class User extends UserAuth
{

    protected $guarded=['id'];

    protected $hidden=['password','remember_token'];


    public function Organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function Role()
    {
        return $this->hasMany(Role::class,'created_by','id');
    }
    public function User_Role()
    {
        return $this->hasOne(User_Role::class,'users_id');
    }
    public function Module()
    {
        return $this->hasMany(Module::class,'created_by','id');
    }
    public function Permission()
    {
        return $this->hasMany(Permission::class,'created_by','id');
    }
    public function Department()
    {
        return $this->hasOne(Department::class,'department_id','id');
    }
    public function UserCreatedBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function UserUpdatedBy()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function OrganizationCreatedBy()
    {
        return $this->hasMany(Organization::class,'created_by','id');
    }
    public function OrganizationUpdatedBy()
    {
        return $this->hasMany(Organization::class,'updated_by','id');
    }
    public function trash_created_by()
    {
        return $this->hasMany(trash::class,'created_by','id');
    }
    public function DepartmentCreatedby()
    {
        return $this->hasMany(Department::class,'created_by','id');
    }
    public function DepartmentUpdatedby()
    {
        return $this->hasMany(Department::class,'updated_by','id');
    }
    public function OrganizationDeletedBy()
    {
        return $this->hasMany(Organization::class,'deleted_by','id');
    }





}
