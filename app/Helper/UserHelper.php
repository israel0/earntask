<?php

namespace App\Helper;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Stage;
/**
 *  User Helper -----------------------------------------------------
 */
class UserHelper {

     public static function SpecificUserData() {
         return User::where("id", auth()->user()->id)->first();
     }

     public static function WalletDataByUser() {
         return Wallet::where("userName" , Self::SpecificUserData()->userName)->first();
     }

     public static function UserStage() {
         return Stage::where([
              "plan" => 1, // Suppose to be user's current plan,
              "stage_id" => 0 // Stage ID by user
         ])->first();
     }
}
