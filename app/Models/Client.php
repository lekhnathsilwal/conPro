<?php

namespace App\Models;

use App\Models\clientCRUD\ClientDetail;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded=['id'];
    public $table="clients";


    public function organization()
    {
        return $this->belongsTo(Organization::class,'organizations_id','id');
    }
    public function client_created()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function client_updated()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function client_deleted()
    {
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function clientDetail()
    {
        return $this->hasMany(ClientDetail::class,'clients_id','id');
    }

}
