<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public static function activityLogs($descriptions,$user){
        $activityLog = new ActivityLog();
        $activityLog->descriptions = $descriptions;
        $activityLog->user_id = $user;
        $activityLog->save();
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
