<?php

namespace App\Models\userCRUD;

use App\Models\trash;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table="modules";

    protected $guarded=['id'];

    public function Permission()
    {
        return $this->hasOne(Permission::class,'modules_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function Role_Permission()
    {
        return $this->belongsTo(Role_Permission::class,'modules_id','id');
    }
    public function Trash()
    {
        return $this->hasMany(trash::class,'modules','id');
    }
}
