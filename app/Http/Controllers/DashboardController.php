<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Activation;
use App\Models\ActivationCode;
use App\Models\User;
use App\Models\Plan;
use App\Models\Withdrawal;
use App\Models\Notification;
use App\Models\Stage;
use App\Models\Wallet;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(function (Request $request, Closure $next) {
            $user = $request->user();
            if ($user && $user->status == User::$USER_SUSPENDED) {
                return to_route("suspended_account");
            }
            return $next($request);
        })->except("suspended_account", "suspended_account_action");
    }

    //  User Dashboard
    public function index()
    {
        $data["title"] = "Dashboard";
        $data["activeMenu"] = 1;
        $user = auth()->user();
        $data['user'] = auth()->user();
        $data['wallet'] = Wallet::getWallet($user->userName);
        $data["plan"] = Plan::getPlan($user->plan);
        $data["referral"] = User::getUser($user->referralName);
        $data['referralcount'] = User::getTotalReferrals($user->userName);
        return view("user.dashboard", $data);
    }

    // Upgrade  Account Page
    public function upgrade_account(Request $request)
    {
        $data["title"] = "Upgrade Account";
        return view("user.upgrade_account", $data);
    }

    // Change Password Method
    public function changePassword(Request $request)
    {
        try {
            if ($request->password != $request->confirm_password) {
                return redirect()->route("user_change_password")->with("error", "Password Supplied Not marched!");
            }
            $username = auth()->user()->userName;
            $user = User::where("userName", $username);
            DB::beginTransaction();
            $newPassword = $request->password;
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $user->update(['password' => $hashedPassword]);
            DB::commit();
            return Helper::Redirection($user, 'user_change_password', "Updated Successfully");
        } catch (Exception $e) {
            DB::rollBack();
            return "Exception" . $e;
        }
    }

    // Upgrade Account Method
    public function upgrade_account_method(Request $request)
    {
        $data["title"] = "Register";
        $validate = $request->validate([
            "activationCode" => "required|integer|digits:11"
        ]);
        $activationCode = $validate["activationCode"];
        $activationCodeObj = ActivationCode::where("activationCode", $activationCode)->first();
        $user = $request->user();
        if (!$activationCodeObj || $activationCodeObj->status != ActivationCode::$ACTIVATION_PURCHASED || $activationCodeObj->plan != $user->plan) {
            session()->flash("error", "Invalid Activation Code. Please try again.");
            return back()->withInput();
        }
        $activationCodeObj->status = ActivationCode::$ACTIVATION_USED;
        $activationCodeObj->dateUsed = now();
        $activationCodeObj->activatedUser = $user->userName;
        $activationCodeObj->save();
        $activation = new Activation();
        $activation->userName = $user->userName;
        $activation->type = Activation::$CODE_ACTIVATED;
        $activation->plan = $user->plan;
        $activation->dateActivated = now();
        $activation->activationCode = $activationCode;
        $activation->save();
        Helper::activate_user($user);
        return to_route("dashboard");
    }



    public function settings(Request $request)
    {
        $data["title"] = "My Account";
        $data['user'] = auth()->user();
        $data["activeMenu"] = 2;
        $user = auth()->user();
        $data['referrals'] = User::getAllReferrals($user->userName);
        $data['referralcount'] = User::getTotalReferrals($user->userName);
        return view("user.settings.index", $data);
    }

    public function updateUserInformation(Request $request)
    {
        $user = User::where("id", auth()->user()->id)->update([
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
        return Helper::Redirection($user, 'user_settings', "Update Account Successfully");
    }


    public function uploadProfile(Request $request)
    {
        if ($request->hasFile('photoUrl')) {
            $file = $request->file('photoUrl');
            if ($this->isImage($file)) {
                if ($this->isFileSizeValid($file)) {
                    $user = auth()->user();
                    $filename = $request->file("photoUrl")->store("profile_pictures", 'public');
                    $upload = User::where("userName", $user->userName)->update([
                        "photoUrl" => $filename
                    ]);
                    return Helper::Redirection($upload, 'user_change_picture', "Upload Profile Successfully");
                } else {
                    return redirect()->route('user_change_picture')->with('error', 'File size exceeds the allowed limit.');
                }
            } else {
                return redirect()->route('user_change_picture')->with('error', 'Invalid file type. Please upload only JPEG or PNG files.');
            }
        } else {
            return redirect()->route('user_change_picture')->with('error', 'No file uploaded.');
        }
    }

    private function isImage($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png'];

        return in_array($file->getMimeType(), $allowedTypes);
    }

    private function isFileSizeValid($file)
    {
        $maxFileSize = 2048;

        return $file->getSize() <= $maxFileSize * 1024;
    }


    public function change_password(Request $request)
    {
        $data["title"] = "Change Password";
        $data["activeMenu"] = 2;
        return view("user.settings.change_password", $data);
    }

    public function change_pin(Request $request)
    {
        $data["title"] = "Change Transaction Pin";
        $data["activeMenu"] = 2;
        return view("user.settings.change_pin", $data);
    }

    public function change_picture(Request $request)
    {
        $data["title"] = "Change Picture";
        $data["activeMenu"] = 2;
        $user = auth()->user();
        $data['user'] = $user;
        $data['referrals'] = User::getAllReferrals($user->userName);
        $data['referralcount'] = User::getTotalReferrals($user->userName);
        return view("user.settings.change_picture", $data);
    }

    public function genealogy(Request $request, $stage = null)
    {
        $data["title"] = "Genealogy";
        $data["activeMenu"] = 3;
        $user = auth()->user();
        if ($stage === null) {
            $userStage = Stage::getStage($user->stage);
            $stage = $userStage->stage_id;
        }
        $stage = Stage::getStageFromplan($stage, $user->plan);
        $data['user'] = $user;
        $data['stage'] = $stage;
        $genealogyData = $stage->getStageGenealogy($user->userName);
        $data["genealogyData"] = $genealogyData;
        return view("user.genealogy", $data);
    }

    public function referrals(Request $request)
    {
        $user = auth()->user();
        $data["title"] = "Referrals";
        $data['referrals'] = User::getAllReferrals($user->userName);
        $data['referralcount'] = User::getTotalReferrals($user->userName);
        $data["activeMenu"] = 4;
        return view("user.referrals", $data);
    }

    public function downlines(Request $request)
    {
        $user = auth()->user();
        $data["title"] = "Downlines";
        $data["activeMenu"] = 5;
        $data['downlinecount'] = User::getCountDownlines($user->userName);
        $data['downlines'] = User::getAllTotalDownlines($user->userName);
        return view("user.downlines", $data);
    }

    public function activation_codes(Request $request)
    {
        $user = auth()->user();
        $data["title"] = "Activation Codes";
        $data["activeMenu"] = 6;
        $data['activationCodecount'] = User::ActivationCodeCount($user->userName);
        $data['activationCodes'] = User::UserActivationCode($user->userName);
        return view("user.activation_codes", $data);
    }

    public function transactions(Request $request)
    {
        $user = auth()->user();
        $data["title"] = "Transactions";
        $data["activeMenu"] = 7;
        $data['user'] = $user;

        $data['matrixWallets'] = User::matrixWallets($user->userName);
        $data['matrixWalletCount'] = User::matrixWalletCount($user->userName);


        return view("user.transactions", $data);
    }

    public function referralWallet()
    {
        $user = auth()->user();
        $data["title"] = "Referral Wallet Transactions";
        $data["activeMenu"] = 7;
        $data['user'] = $user;


        $data['referralWallets'] = User::referralWallets($user->userName);
        $data['referralWalletCount'] = User::referralWalletCount($user->userName);

        return view("user.referral_wallet", $data);
    }

    public function GroupBonusWallet()
    {
        $user = auth()->user();
        $data["title"] = "Group Bonus Wallet Transactions";
        $data["activeMenu"] = 7;
        $data['user'] = $user;
        $data['groupBonusWallets'] = User::groupBonusWallets($user->userName);
        $data['groupBonusWalletCount'] = User::groupBonusWalletCount($user->userName);

        return view("user.group_bonus_wallet", $data);
    }

    public function StepOutWallet()
    {
        $user = auth()->user();
        $data["title"] = "Group Bonus Wallet Transactions";
        $data["activeMenu"] = 7;
        $data['user'] = $user;

        $data['stepoutWallets'] = User::stepoutWallets($user->userName);
        $data['stepoutWalletCount'] = User::stepoutWalletCount($user->userName);

        return view("user.stepout_wallet", $data);
    }

    public function StageBonusWallet()
    {
        $user = auth()->user();
        $data["title"] = "Stage Bonus Wallet Transactions";
        $data["activeMenu"] = 7;

        $data['stageBonusWallets'] = User::stageBonusWallets($user->userName);
        $data['stageBonusWalletCount'] = User::stageBonusWalletCount($user->userName);

        $data['user'] = $user;
        return view("user.stage_bonus_wallet", $data);
    }

    public function deleteNotification($id)
    {
        $delete = Notification::where("id", $id)->delete();
        return Helper::Redirection($delete, "user_notifications", "Delete Notification Successfully");
    }


    public function makeWithdraw(Request $request)
    {
        $validator = $request->validate(
            [
                "amount" => "required|integer",
                'bankName' => 'required',
                'bankAccountNumber' => 'required',
                'bankAccountName' => 'required',
                // 'pin' => 'required|integer|digits:4'
            ],
        );
        $user = User::getUser(auth()->user()->userName);
        $walletObj = Wallet::getWallet(($user->userName));
        $wallet = $request->wallet;
        $amount = $request->amount;
        switch ($wallet) {
            case Transaction::$MATRIX_WALLET:
                if ($amount < 1000) {
                    session()->flash("error", "Minimum Withdrawal Amount on Matrix Wallet is NGN1,000.");
                    return back()->withInput();
                }
                if ($walletObj->matrixBonus < $amount) {
                    session()->flash("error", "The amount you entered is greater than your matrix wallet balance.");
                    return back()->withInput();
                }
                break;
            case Transaction::$REFERRAL_WALLET:
                if ($amount < 100) {
                    session()->flash("error", "Minimum Withdrawal Amount on Referral Wallet is NGN1,000.");
                    return back()->withInput();
                }
                if ($walletObj->referralBonus < $amount) {
                    session()->flash("error", "The amount you entered is greater than your referral wallet balance.");
                    return back()->withInput();
                }
                break;
            case Transaction::$STEP_OUT_WALLET:
                if ($amount < 1000) {
                    session()->flash("error", "Minimum Withdrawal Amount on Stepout Wallet is NGN1,000.");
                    return back()->withInput();
                }
                if ($walletObj->stepOutBonus < $amount) {
                    session()->flash("error", "The amount you entered is greater than your stepout wallet balance.");
                    return back()->withInput();
                }
                break;
            case Transaction::$STAGE_BONUS_WALLET:
                if ($amount < 1000) {
                    session()->flash("error", "Minimum Withdrawal Amount on Stage Wallet is NGN1,000.");
                    return back()->withInput();
                }
                if ($walletObj->stageBonus < $amount) {
                    session()->flash("error", "The amount you entered is greater than your stage wallet balance.");
                    return back()->withInput();
                }
                break;
            case Transaction::$GROUP_BONUS_WALLET:
                if ($amount < 1000) {
                    session()->flash("error", "Minimum Withdrawal Amount on Group Bonus Wallet is NGN1,000.");
                    return back()->withInput();
                }
                if ($walletObj->groupBonus < $amount) {
                    session()->flash("error", "The amount you entered is greater than your group wallet balance.");
                    return back()->withInput();
                }
                break;
        }
        $withdraw = Withdrawal::create([
            "wallet" => $request->wallet,
            "withdrawTo" => "Bank",
            "amount" => $request->amount,
            "bankName" =>  $request->bankName,
            "bankAccountNumber" =>  $request->bankAccountNumber,
            "bankAccountName" =>  $request->bankAccountName,
            "userName" =>  $user->userName,
            "withdrawalStatus" => Withdrawal::$WITHDRAW_AVAILABLE
        ]);
        $user->bankAccountNumber = $request->bankAccountNumber;
        $user->bankAccountName = $request->bankAccountName;
        $user->bankName = $request->bankName;
        $user->save();
        Transaction::createDebitTransaction($wallet, $amount, $user->userName);
        session()->flash("success", "Your Withdrawal of N$amount is successful! The funds will be processed into your bank account within 48hrs");
        return back()->withInput();
    }

    public function update_review(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "review" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $withdraw = Review::create([
            "review" => $request->review,
            "userName" => auth()->user()->userName,
            "active" => true
        ]);
        return Helper::Redirection($withdraw, 'dashboard', "Review Submitted Successfully");
    }

    private function createWalletData($wallet)
    {
        return array(
            [
                "name" => "Referral Wallet",
                "value" => Transaction::$REFERRAL_WALLET,
                'amount' => $wallet->referralBonus
            ],
            [
                "name" => "Matrix Wallet",
                "value" => Transaction::$MATRIX_WALLET,
                'amount' => $wallet->matrixBonus
            ],

            [
                "name" => "StepOut Wallet",
                "value" => Transaction::$STEP_OUT_WALLET,
                'amount' => $wallet->stepOutBonus
            ],

            [
                "name" => "Group Wallet",
                "value" => Transaction::$GROUP_BONUS_WALLET,
                'amount' => $wallet->groupBonus
            ],
            [
                "name" => "Stage Wallet",
                "value" => Transaction::$STAGE_BONUS_WALLET,
                'amount' => $wallet->stageBonus
            ],
        );
    }

    public function withdraw(Request $request)
    {
        $data["title"] = "Withdraw";
        $data["activeMenu"] = 8;
        $data['user'] = auth()->user();
        $user = auth()->user();
        $wallet = Wallet::getWallet($user->userName);
        $data['wallets'] = $this->createWalletData($wallet);
        $data['withdrawals'] = User::getAllWithdrawals($user->userName);
        $data['withdrawalcount'] = User::getTotalWithdrawals($user->userName);
        return view("user.withdraw", $data);
    }

    public function notifications(Request $request)
    {
        $user = auth()->user();
        $data["title"] = "Notifications";
        $data["activeMenu"] = 9;
        $data["notificationcount"] = User::getTotalNotification($user->userName);
        $data['notifications'] = User::getAllNotifications($user->userName);
        return view("user.notifications", $data);
    }



    public function searchReferrals(Request $request)
    {
        $username = $request->input('username');

        $referrals = User::where('referralName', $username)
            ->where(function ($query) use ($username) {
                $query->where('userName', 'LIKE', "%$username%")
                    ->orWhere('phoneNumber', 'LIKE', "%$username%");
            })
            ->paginate(100);

        return view('referrals', compact('referrals'));
    }



    public function searchReferralData(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query();

            if (!empty($request->get('username'))) {
                $query->where('referralName', 'like', '%' . $request->get('username') . '%');
            }

            return DataTables::of($query)
                ->addColumn('status', function ($user) {
                    return ($user->status == User::$USER_PENDING) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Activated</p>';
                })
                ->make(true);
        }

        return response()->json(['message' => 'Invalid Request'], 400);
    }
}
