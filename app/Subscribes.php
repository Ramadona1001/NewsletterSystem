<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribes extends Model
{
    public static function checkSubscribe($email){
        $subscribe = Subscribes::where('email',$email)->get()->first();
        if ($subscribe != null) {
            if ($subscribe->status == 1) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
