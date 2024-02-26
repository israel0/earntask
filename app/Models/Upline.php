<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Upline extends Model
{
    use HasFactory;

    public static $LEFT_LEG = 1;
    public static $RIGHT_LEG = 2;

    public static function createAllUserUplines($userName)
    {
        $uplines = [];
        Self::getAllUplines($userName, $uplines);
        foreach ($uplines as $upline) {
            $userUpline = $upline->upline;
            $type = $upline->type;
            $newUpline = new Upline();
            $newUpline->userName = $userName;
            $newUpline->upline = $userUpline;
            $newUpline->type = $type;
            $newUpline->level = $upline->level;
            $newUpline->id = 0;
            $newUpline->save();
        }
    }

    public static function getAllUplines($userName, &$uplines, $level = 1)
    {
        $directUpline = User::getUpline($userName);
        if ($directUpline != null && strlen($directUpline) != 0) {
            $type = User::getUplineIndex($userName, $directUpline);
            // dd($type);
            if ($type) {
                $upline = new Upline();
                $upline->userName = $userName;
                $upline->upline = $directUpline;
                $upline->type = $type;
                $upline->level = $level;
                $upline->id = 0;
                array_push($uplines, $upline);
                Self::getAllUplines($directUpline, $uplines, ++$level);
            }
        }
    }

    public static function getUplinesFromDb($userName)
    {
        $uplines = self::where("userName", $userName)->get();
        return $uplines;
    }

    //getDownlinesWithStageAndLeg

    public static function getAllDownlinesWithinStageAndLeg($userName, $stage, $leg)
    {
        $orderString = "";
        switch ($stage->stage_id) {
            case 1:
                $orderString = "users.stageOneDate";
                break;
            case 2:
                $orderString = "users.stageTwoDate";
                break;
            case 3:
                $orderString = "users.stageThreeDate";
                break;
            case 4:
                $orderString = "users.stageFourDate";
                break;
            case 5:
                $orderString = "users.stageFiveDate";
                break;
            case 0:
                $orderString = "users.userEntranceDate";
                break;
        }
        $downlines = DB::table('uplines')
            ->join('users', 'uplines.userName', '=', 'users.userName')
            ->where("uplines.upline", "=", $userName)
            ->where("users.stage", "=", $stage->id)
            ->where("uplines.type", "=", $leg)
            ->select('uplines.userName', 'uplines.upline', 'uplines.type', 'users.stage')
            ->orderBy($orderString, "asc")
            ->get();
        return $downlines;
    }

    public static function getAllDownlinesWithinStageAndLegWithLimit($userName, $stage, $leg, $limit)
    {
        $orderString = "";
        switch ($stage->stage_id) {
            case 1:
                $orderString = "users.stageOneDate";
                break;
            case 2:
                $orderString = "users.stageTwoDate";
                break;
            case 3:
                $orderString = "users.stageThreeDate";
                break;
            case 4:
                $orderString = "users.stageFourDate";
                break;
            case 5:
                $orderString = "users.stageFiveDate";
                break;
            case 0:
                $orderString = "users.userEntranceDate";
                break;
        }
        $downlines = DB::table('uplines')
            ->join('users', 'uplines.userName', '=', 'users.userName')
            ->where("uplines.upline", "=", $userName)
            ->where("users.stage", "=", $stage->id)
            ->where("uplines.type", "=", $leg)
            ->select('uplines.userName', 'uplines.upline', 'uplines.type', 'users.stage')
            ->orderBy($orderString, "asc")
            ->limit($limit)
            ->get();
        return $downlines;
    }

    public static function getAllDownlinesCountWithinStageAndLeg($userName, $stage, $leg)
    {
        $count = DB::table('uplines')
            ->join('users', 'uplines.userName', '=', 'users.userName')
            ->where("uplines.upline", "=", $userName)
            ->where("users.stage", "=", $stage->id)
            ->where("uplines.type", "=", $leg)
            ->select('uplines.userName', 'uplines.upline', 'uplines.type', 'users.stage')
            ->count();
        return $count;
    }

    public static function getAllUplinesWithinStage($userName, $stage)
    {
        $uplines = DB::table('uplines')
            ->join('users', 'uplines.upline', '=', 'users.userName')
            ->where("uplines.userName", "=", $userName)
            ->where("users.stage", "=", $stage->id)
            ->select('uplines.userName', 'uplines.upline', 'uplines.type', 'users.stage')
            ->get();
        return $uplines;
    }

    public static function getType($userName, $upline)
    {
        $uplineObj = Upline::where([
            "userName" => $userName,
            "upline" => $upline
        ])->first();
        if ($uplineObj) return $uplineObj->type;
        else return null;
    }

    public static function getAllDownlinesWithinStage($userName, $stage)
    {
        $downlines = DB::table('uplines')
            ->join('users', 'uplines.userName', '=', 'users.userName')
            ->where("uplines.upline", "=", $userName)
            ->where("users.stage", "=", $stage->id)
            ->select('uplines.userName', 'uplines.upline', 'uplines.type', 'users.stage')
            ->get();
        return $downlines;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userName', 'userName');
    }

    public static function DirectUpline($userName)
    {
        return Upline::where("userName", $userName)->pluck("upline");
    }
}
