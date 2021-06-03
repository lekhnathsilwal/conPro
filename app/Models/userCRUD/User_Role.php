<?php

namespace App\Models\userCRUD;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    protected $table="user_roles";

    protected $guarded=['id'];

    public function User()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function Role()
    {
        return $this->belongsTo(Role::class,'roles_id');
    }
}
