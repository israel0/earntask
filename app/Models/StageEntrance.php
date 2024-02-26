<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageEntrance extends Model
{
    use HasFactory;

    public static function checkStageEntranceInfo($upline, $stage, $userName, $type)
    {
        return StageEntrance::where([
            "upline" => $upline,
            "stage" => $stage,
            "userName" => $userName,
            "type" => $type
        ])->count();
    }

    public static function getDownlineAmountInStageInfo($upline, $type, $stage)
    {
        return StageEntrance::where([
            "upline" => $upline,
            "stage" => $stage,
            "type" => $type
        ])->count();        
    }
}
