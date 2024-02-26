<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Helper\Helper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["prefix" => "user", "controller" => DashboardController::class], function () {
    Route::get("/", "index")->name("dashboard");
    Route::get("/dashboard", "index")->name("dashboard");
    Route::get("/settings", "settings")->name("user_settings");
    Route::get("/settings/change_password", "change_password")->name("user_change_password");
    Route::get("/settings/change_pin", "change_pin")->name("user_change_pin");
    Route::get("/settings/change_picture", "change_picture")->name("user_change_picture");
    Route::get("/genealogy/{stage?}", "genealogy")->name("user_genealogy");
    Route::get("/transactions", "transactions")->name("user_transactions");
    Route::get("/withdraw", "withdraw")->name("user_withdraw");
    Route::get("/downlines", "downlines")->name("user_downlines");
    Route::get("/referrals", "referrals")->name("user_referrals");
    Route::get("/activation_codes", "activation_codes")->name("user_activation_codes");
    Route::get("/notifications", "notifications")->name("user_notifications");
    Route::get("/activate_reg", "activate_reg")->name("activate_reg");
    Route::post("/activate_reg", "activate_reg_action");
    Route::post("/update_account", 'updateUserInformation')->name("update_account");
    Route::post('/password_update_account', 'ChangePassword')->name('password_update_account');
    Route::post('/pin_update_account', 'ChangePin')->name('pin_update_account');
    Route::post("/make_withdraw", "makeWithdraw")->name("make_withdraw");
    Route::post('/update_profile_picture', 'uploadProfile')->name("update_picture");
    Route::get("/referral_wallet",  "referralWallet")->name("referral_wallet");
    Route::get("/group_bonus_wallet", "GroupBonusWallet")->name("group_bonus_wallet");
    Route::get("/stepout_wallet", "StepoutWallet")->name("stepout_wallet");
    Route::get("stage_bonus_wallet", "StageBonusWallet")->name("stage_bonus_wallet");
    Route::delete('delete_notification/{id}', 'deleteNotification')->name('delete_notification');
    Route::post("/update_review", "update_review")->name("update_review");
    // search
    Route::get('/get-data/{username}', 'getAllReferrals')->name('get-data');
    Route::get('/search-referral-data', 'searchReferralData')->name('search-referral-data');
});

Route::group(["prefix" => "admin", "controller" => AdminController::class], function () {

    Route::get("/users/{status?}", "users")->name("admin_users");
    Route::get("/stages/{plan?}/{stage_id?}", "stages")->name("admin_stages");
    Route::get("/withdrawals/{status?}", "withdrawals")->name("admin_withdrawals");
    Route::get("/process_withdrawal/{id}", "processWithdrawal")->name("process_withdrawals");
    // Activation Code Routes
    Route::get("/activation_codes/{type?}", "activation_codes")->name("admin_activation_codes");
    Route::get("/generate_codes", "generate_activation_code")->name("generate_code");
    Route::get("/send_code", "send_activation_code")->name("send_code");
    Route::post("/generate-activation-code", "generateActivationCode")->name("generate-activation-code");
    Route::post("/send_code", "sendActivationCodes")->name("send-activation-code");

    //BroadCast
    Route::get("/broadcast", "broadcast")->name("broadcast");
    Route::post("/update-broadcast", "updateBroadcast")->name("update-boardcast");

    //View User Settings
    Route::get("/view_user/{userName}", "view_user")->name("admin_view_user");
    Route::post("/update_user/{userName}", "updateUser")->name("admin_update_user");
    Route::get("/change_password/{userName}", "change_password")->name("admin_change_password");
    Route::post("/update_password/{userName}", "updatePassword")->name("admin_update_password");
    Route::get("/change_pin/{userName}", "change_pin")->name("admin_change_pin");
    Route::post("/update_pin/{userName}", "updatePin")->name("admin_update_pin");

    Route::redirect('/', '/admin/users');
});

Route::group(["prefix" => "auth", "controller" => AuthController::class], function () {
    Route::get("/login", "login")->name("login");
    Route::post("/login", "");
    Route::get("/register", "register")->name("register");
    Route::post("/register", "registerNewUser");
    Route::post("/validate_referral", "validate_referral");
    Route::get("/logout", "logout")->name("logout");

    Route::get("/password/forgot" , 'showForgetForm')->name("forgot.password");
    Route::get('/password/reset', 'showResetForm')->name('password.request');
    Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('/password/reset', 'reset')->name("password.update");

});

Route::group(["controller" => HomeController::class], function () {
    Route::get("/about", "about")->name("about");
    Route::get("/help", "help")->name("help");
    Route::get("/about", "about")->name("about");
    Route::get("/invest", "invest")->name("invest");
    Route::get("/plan", "compensation_plan")->name("plan");
    Route::get("/", "index")->name("landing");
    Route::get("/policy", "policy")->name("policy");
    Route::get("/auto_reg/{start}/{limit}", "auto")->name("auto");
    Route::post("/auto_reg/{referralName}/{index}", "auto_reg")->name("auto_reg");
});
