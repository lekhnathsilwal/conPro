<?php

namespace App\Models;

use App\Models\userCRUD\Role;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table='organizations';
    protected $guarded=['id'];
    protected $fillable=['name','email'];

    public function OrganizationCreatedBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function User()
    {
        return $this->hasMany(User::class,'organizations_id','id');
    }
    public function OrganizationDeletedBy()
    {
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function Role()
    {
        return $this->hasMany(Role::class,'organizations_id','id');
    }
    public function Department()
    {
        return $this->hasMany(Department::class,'organizations_id','id');
    }
    public function Employee()
    {
        return $this->hasMany(Employee::class,'organizations_id','id');
    }
}
