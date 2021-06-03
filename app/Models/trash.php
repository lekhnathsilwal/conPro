<?php

namespace App\Models;

use App\Models\userCRUD\Module;
use Illuminate\Database\Eloquent\Model;

class trash extends Model
{
    protected $table='trash';

    protected $guarded=['id'];

    protected $fillable=['modules,data_id,created_by'];

    public function Module()
    {
        return $this->belongsTo(Module::class,'modules','id');
    }
    public function trash_created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }


}
