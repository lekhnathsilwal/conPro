<?php

namespace App\Models\clientCRUD;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    public $guarded=['id'];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }
}
