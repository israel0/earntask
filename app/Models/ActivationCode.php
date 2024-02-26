<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    use HasFactory, HasUuids;

    public static $ACTIVATION_GENERATED = 1;
    public static $ACTIVATION_PURCHASED = 2;
    public static $ACTIVATION_USED = 3;

    public static function getTotalActivationCodes($status = null)
    {
        if ($status) return ActivationCode::where("status", $status)->count();
        else return ActivationCode::count();
    }

    public static function getplanActivationCodesCount($plan, $status = null)
    {
        if ($status) return ActivationCode::where("plan", $plan)->where("status", $status)->count();
        else return ActivationCode::where("plan", $plan)->count();
    }

    public static function getAllActivationCodes($search = "", $type = null)
    {
        $query = null;
        if ($type) {
            $query = ActivationCode::where("status", $type);
            if (!empty($search)) {
                $query->where(function (Builder $query2) use (&$search) {
                    $query2->where("activationCode", "REGEXP", $search);
                    $query2->orWhere("purchasedUser", "REGEXP", $search);
                });
            }
        } else {
            if (!empty($search)) {
                $query = ActivationCode::where("activationCode", "REGEXP", $search);
                $query->orWhere("purchasedUser", "REGEXP", $search);
            } else {
                $query = ActivationCode::where([]);
            }
        }
        return $query->orderBy("created_at", "desc")->paginate(100);
    }

    public static function getAllActivationCodesCount($search = "", $type = null)
    {
        $query = null;
        if ($type) {
            $query = ActivationCode::where("status", $type);
            if (!empty($search)) {
                $query->where(function (Builder $query2) use (&$search) {
                    $query2->where("activationCode", "REGEXP", $search);
                    $query2->orWhere("purchasedUser", "REGEXP", $search);
                });
            }
        } else {
            if (!empty($search)) {
                $query = ActivationCode::where("activationCode", "REGEXP", $search);
                $query->orWhere("purchasedUser", "REGEXP", $search);
            } else {
                $query = ActivationCode::where([]);
            }
        }
        return $query->count();
    }

    public static function generateActivationCodes($size, $plan)
    {
        $count = 0;
        for ($i = 0; $i < $size; $i++) {
            $random = rand(99999999999, 10000000000);
            while (ActivationCode::where("activationCode", $random)->first()) {
                $random = rand(99999999999, 10000000000);
            }
            $activationCodeObj = new ActivationCode();
            $activationCodeObj->activationCode = $random;
            $activationCodeObj->plan = $plan;
            $activationCodeObj->status = ActivationCode::$ACTIVATION_GENERATED;
            $activationCodeObj->save();
            $count++;
        }
        return $count;
    }

    public static function sendActivationCodes($size, $plan, $userName)
    {
        $activationCodes = ActivationCode::where([
            "plan" => $plan,
            "status" => ActivationCode::$ACTIVATION_GENERATED
        ])->limit($size)->get();
        $count = 0;
        foreach ($activationCodes as $activationCode) {
            $activationCode->datePurchased = now();
            $activationCode->purchasedUser = $userName;
            $activationCode->status = ActivationCode::$ACTIVATION_PURCHASED;
            $activationCode->save();
            $count++;
        }
        return $count;
    }
}
