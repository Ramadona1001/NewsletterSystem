<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
