<?php

namespace App\Models\projectCRUD;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Project_Partie extends Model
{
    protected $table='project_parties';

    protected $guarded=['id'];

    public function Project()
    {
        return $this->belongsTo(Project::class,'projects_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
