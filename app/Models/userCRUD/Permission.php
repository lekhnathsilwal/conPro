<?php

namespace App\Models\userCRUD;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';

    protected $guarded=['id'];

    public function Module()
    {
        return $this->belongsTo(Module::class,'modules_id','id');
    }
    public  function User()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
