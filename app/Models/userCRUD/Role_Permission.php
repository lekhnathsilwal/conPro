<?php

namespace App\Models\userCRUD;

use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    protected $table='role_permissions';

    protected $guarded=['id'];

    public function Role()
    {
        return $this->belongsTo(Role::class,'roles_id','id');
    }
    public function Permission()
    {
        return $this->belongsTo(Permission::class,'permissions_id','id');
    }

}
