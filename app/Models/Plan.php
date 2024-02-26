<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Plan extends Model
{
    use HasFactory;

    public static $basicPlan = 1;

    public static $silverPlan = 2;

    public static $goldenPlan = 3;

    protected $guarded = [];

    public static function getPlan($id)
    {
        return Plan::where("id", $id)->first();
    }

    public static function getAllplans() {
          return Plan::all();
    }
}
