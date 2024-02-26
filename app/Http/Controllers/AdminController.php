<?php

namespace App\Http\Controllers;

use App\Models\ActivationCode;
use Closure;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\plan;
use App\Models\Broadcast;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Stage;
use Exception;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(function (Request $request, Closure $next) {
            $user = $request->user();
            if (!$user || !$user->is_admin) {
                return to_route("dashboard");
            }
            return $next($request);
        });
    }

    public function users($status = null)
    {
        $data["status"] = $status;
        $title = ucfirst($status);
        $data["title"] = !$status ? "All Users" : "All $title Users";
        if ($status === "active") $status = User::$USER_ACTIVATED;
        if ($status === "pending") $status = User::$USER_PENDING;
        if ($status === "suspended") $status = User::$USER_SUSPENDED;
        $data["adminMenu"] = 1;
        $search = null;
        if (isset($_REQUEST["username"]) && !empty($_REQUEST["username"])) {
            $search = $_REQUEST["username"];
            $data["username"] = $search;
        }
        $data['usercount'] = User::getTotalUsers($search, $status);
        $data['users'] = User::getAllUsers($search, $status);
        return view("admin.users.index", $data);
    }

    public function stages($plan = 1, $stage_id = 0)
    {
        $title = "STAGES & planS";
        $search = null;
        if (isset($_REQUEST["username"]) && !empty($_REQUEST["username"])) {
            $search = $_REQUEST["username"];
            $data["username"] = $search;
        }

        $stage = Stage::getStageFromplan($stage_id, $plan);
        $users = User::getAllUserinStageandplan($plan, $stage->id, $search);
        $usercount =  User::getTotalUserinStageandplan($plan, $stage->id, $search);
        $data["userTitle"] = "$stage->rank Users";
        $data['plan'] = plan::getplan($plan);
        $data['stage_id'] = $stage_id;
        $data["title"] = $title;
        $data["stage"] = $stage;
        $data["adminMenu"] = 2;
        $data["users"] =  $users;
        $data["usercount"] = $usercount;
        $data["plans"] = plan::getAllplans();
        $data["stages"] = Stage::getStagesFromplan($plan);
        return view("admin.stages", $data);
    }

    public function send_activation_code()
    {
        $data["title"] = "Send Activation Codes";
        $data["adminMenu"] = 3;
        $data["plans"] = plan::getAllplans();
        return view("admin.activation_code.send_activation_code", $data);
    }


    public static function generateActivationCode(Request $request)
    {

        $validator = $request->validate([
            "size" => "required|integer|max:100",
            'plan' => 'required|exists:plans,id',
        ]);
        try {
            $plan = plan::getplan($request->plan);
            $result = ActivationCode::generateActivationCodes($request->size, $request->plan);
            session()->flash("success", "$result Activation Codes for $plan->name plan Generated Successfully");
            return back()->withInput();
        } catch (Exception $e) {
            return "Exception" . $e;
        }
    }

    public static function sendActivationCodes(Request $request)
    {

        $validator = $request->validate([
            "size" => "required|integer",
            'plan' => 'required|exists:plans,id',
            'username' => [
                'required', "exists:users,userName"
            ],
        ]);
        try {
            $userName = $validator["username"];
            $size = $validator["size"];
            $plan = $validator["plan"];
            $planObj = plan::getplan($plan);
            $rem_codes_for_plan = ActivationCode::getplanActivationCodesCount($plan, ActivationCode::$ACTIVATION_GENERATED);
            if ($rem_codes_for_plan < $size) {
                session()->flash("error", "You don't have enough generated codes for $planObj->name plan. Please generate more activation codes and try again.");
                return back()->withInput();
            }
            $result = ActivationCode::sendActivationCodes($size, $plan, $userName);
            session()->flash("success", "$result Activation Codes for $planObj->name plan Sent to $userName Successfully");
            return back()->withInput();
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function updateBroadcast(Request $request)
    {
        $validator = $request->validate([
            "title" => "required",
            'content' => 'required',
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'display_status' => ($request->display_status == "1") ? 1 : 0
        ];
        $conditions = [
            'id' => 1,
        ];
        $record = Broadcast::updateOrCreate($conditions, $data);
        return Helper::Redirection($record, "broadcast", "Broadcast Updated Successfully");
    }

    public function generate_activation_code($type = null)
    {
        $data["title"] = "Generate Activation Codes";
        $data["adminMenu"] = 3;
        $data["plans"] = plan::getAllplans();
        return view("admin.activation_code.generate_codes", $data);
    }

    public function withdrawals($status = null)
    {
        $data["title"] = "Withdrawals";
        $data["adminMenu"] = 4;
        $search = null;
        if (isset($_REQUEST["username"]) && !empty($_REQUEST["username"])) {
            $search = $_REQUEST["username"];
            $data["username"] = $search;
        }
        $data['withdrawals'] = Withdrawal::getAllWithdrawals($search);
        $data['withdrawalcount'] = Withdrawal::getTotalWithdrawals($search);
        return view("admin.withdrawals", $data);
    }

    public function processWithdrawal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if ($withdrawal) {
            $withdrawal->withdrawalStatus = Withdrawal::$WITHDRAW_TOTAL_PAID_OUT;
            $withdrawal->save();
        }
        return to_route("admin_withdrawals");
    }

    public function broadcast()
    {
        $data["title"] = "Send Broadcast";
        $data["adminMenu"] = 5;
        return view("admin.broadcast", $data);
    }

    public function activation_codes($type = null)
    {
        $title = $type ? ucfirst($type) : "";
        $data["type"] = $type;
        $data["title"] = "Activation Codes";
        $data["tableTitle"] = !$type ? "All Activation Codes" : "All $title Activation Codes";
        if ($type === "new") $type = ActivationCode::$ACTIVATION_GENERATED;
        if ($type === "purchased") $type = ActivationCode::$ACTIVATION_PURCHASED;
        if ($type === "used") $type = ActivationCode::$ACTIVATION_USED;
        $data["adminMenu"] = 3;
        $search = "";
        if (isset($_REQUEST["search"]) && !empty($_REQUEST["search"])) {
            $search = $_REQUEST["search"];
            $data["search"] = $search;
        }
        $data['activationCodeCount'] = ActivationCode::getAllActivationCodesCount($search, $type);
        $data['activationCodes'] = ActivationCode::getAllActivationCodes($search, $type);
        return view("admin.activation_code.index", $data);
    }

    public function view_user($userName)
    {
        $user = User::getUser($userName);
        $data["title"] = "$user->userName's Account";
        if (!$user) return to_route("admin");
        $data['user'] = $user;
        $data["adminMenu"] = 1;
        return view("admin.settings.index", $data);
    }

    public function updateUser(Request $request, $userName)
    {
        $user = User::getUser($userName);
        if (!$user) return to_route("admin");
        $user = User::where("id", $user->id)->update([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "middleName" => $request->middleName,
            "dateOfBirth" => $request->dob,
            "state" => $request->state,
            "address" => $request->address,
            "gender" => $request->gender,
            "phoneNumber" => $request->phoneNumber,
            "email" => $request->email,
            "bankName" => $request->bankName,
            "bankAccountName" => $request->bankAccountName,
            "bankAccountNumber" => $request->bankAccountNumber

        ]);
        session()->flash("success", "Account Updated Successfully");
        return back()->withInput();
    }

    public function change_password($userName)
    {
        $user = User::getUser($userName);
        $data["title"] = "$user->userName's Account";
        if (!$user) return to_route("admin");
        $data['user'] = $user;
        $data["adminMenu"] = 1;
        return view("admin.settings.change_password", $data);
    }

    public function change_pin($userName)
    {
        $user = User::getUser($userName);
        $data["title"] = "$user->userName's Account";
        if (!$user) return to_route("admin");
        $data['user'] = $user;
        $data["adminMenu"] = 1;
        return view("admin.settings.change_pin", $data);
    }

    public function updatePassword(Request $request, $userName)
    {
        try {

            if ($request->password != $request->confirm_password) {
                session()->flash("error", "Password Supplied Not Matched with Confirm Password");
                return back()->withInput();
            }

            $username = $userName;
            $user = User::where("userName", $username);
            if (!$user) return to_route("admin");
            DB::beginTransaction();
            $newPassword = $request->password;
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->update(['password' => $hashedPassword]);
            DB::commit();
            session()->flash("success", "Password Updated Successfully");
            return back()->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return "Exception" . $e;
        }
    }

    public function updatePin(Request $request, $userName)
    {
        try {

            if ($request->pin != $request->confirm_pin) {
                session()->flash("error", "Pin Supplied Not Matched with Confirm Pin");
                return back()->withInput();
            }

            if (Helper::validatePin($request->pin)) {
                $username = $userName;
                $user = User::where("userName", $username);
                if (!$user) return to_route("admin");
                DB::beginTransaction();
                $newPin = $request->pin;
                $hashedPin = password_hash($newPin, PASSWORD_DEFAULT);
                $user->update(['password' => $hashedPin]);
                DB::commit();
                session()->flash("success", "Transaction Pin Updated Successfully");
                return back()->withInput();
            } else {
                session()->flash("error", "Invalid, Supply Only 4 Digit Pin!");
                return back()->withInput();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return "Exception" . $e;
        }
    }
}
