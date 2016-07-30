<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    /**
     * Sends a notification to all users.
     * $type parameter consists of {semesterRequestFormNotification}
     *
     *
     * @param $notification
     * @param $userStatus
     * @param $type
     * @param $url
     *
     * @return void
     */
    public static function sendNotification($notification, $userStatus, $type, $url)
    {
        if(Notifications::where('type','=',$type)->count() > 0)
        {
            $existingNotificationID = Notifications::where('type','=',$type)->value('id');
            Notifications::where('id','=',$existingNotificationID)->update(['updated_at' => Carbon::now()]);
        }
        else
        {
            //If user did not specify a URL, then set it to # indicating null
            if($url == NULL)
            {
                $url = "#";
            }
            $Notification = new Notifications();
            $Notification->notification = $notification;
            $Notification->forAdmin     = $userStatus;
            $Notification->url          = $url;
            $Notification->type         = $type;
            $Notification->save();
        }
    }
}
