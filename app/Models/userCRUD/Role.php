<?php

namespace App\Models\userCRUD;

use App\Models\Organization;
use App\Models\trash;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table="roles";

    protected $guarded=['id'];

    public function User()
    {
        return $this->belongsTo(User::class,'users','created_by');
    }
    public function User_Role()
    {
        return $this->hasMany(User_Role::class,'roles_id','id');
    }
    public function Role_Permission()
    {
        return $this->hasMany(Role_Permission::class,'roles_id','id');
    }
    public function Organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }

}
