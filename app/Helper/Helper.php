<?php

namespace App\Helper;

use App\Models\Notification;
use App\Models\Upline;
use App\Models\User;
use App\Models\Stage;
use App\Mail\SendNotification;
use App\Models\ActivationCode;
use Illuminate\Support\Facades\Mail;

class Helper
{

    public static function ReadNotification()
    {
        return Notification::where("status", 0)->update([
            "status" => 1
        ]);
    }

    public static function validatePin($pin)
    {
        $pattern = "/^\d{4}$/";
        // Perform the regex match
        return preg_match($pattern, $pin) === 1;
    }

    public static function Redirection($action, String $name, String $message)
    {
        if (!$action) {
            return redirect()->route($name)->with("error", "Operation Failed!");
        }
        return redirect()->route($name)->with("success", $message);
    }

    public static function referralUrl($username)
    {
        $referralLink = config("services.site.url") . '/auth/register?ref=' . $username;
        User::where("userName", $username)->update(["pageUrl" => $referralLink]);
        return $referralLink;
    }

    public static function activate_user($user)
    {
        $user->status = User::$USER_ACTIVATED;
        $user->userEntranceDate = now();
        $user->pageUrl = Self::referralUrl($user->userName);
        $user->payment_method = "Activation Code";
        $user->save();
        $notification = new Notification();
        $notification->notification = "Welcome to Paulano Graceland Africa. Your account has been activated successfully and you can now have full access to your dashboard.";
        $notification->status = 0;
        $notification->title = "Welcome to Paulano Graceland Africa!";
        $notification->username = $user->userName;
        $notification->save();

        // send email to Activated Users
        rescue(
            function () use ($user, $notification) {
                return Self::Notifications($user->firstName, $user->email, $notification->notification);
            },
            function ($e) {
                return '';
            }
        );
    }

    public static function Notifications($firstname, $email, $message)
    {
        $data = array("firstname" => $firstname, "message" => $message);
        Mail::to($email)->send(new SendNotification($data));
    }
}
