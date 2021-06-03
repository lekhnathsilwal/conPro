<?php

namespace App\Models;

use App\Models\projectCRUD\Project_File;
use App\Models\projectCRUD\Project_Partie;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='projects';
    protected $guarded=['id'];

    public function Organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function Project_File()
    {
        return $this->hasMany(Project_File::class,'projects_id','id');
    }
    public function Project_Partie()
    {
        return $this->hasMany(Project_Partie::class,'projects_id','id');
    }

}
