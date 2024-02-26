<?php

namespace App\Models;

use App\Helper\Genealogy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Stage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static $NO_OF_LEGS = 2;

    public static $stage_id;

    public static function getStage($stage)
    {
        return Stage::where([
            "id" => $stage // Stage ID by user
        ])->first();
    }

    public static function getStageFromplan($stage_id, $plan)
    {
        return Stage::where([
            "stage_id" => $stage_id,
            "plan" => $plan
        ])->first();
    }

    public static function getStagesFromplan($plan)
    {
        return Stage::where([
            "plan" => $plan
        ])->get();
    }

    public function payReferralBonus($userName, $registeredUser)
    {
        if ($this->stage_id > 0) return;
        Transaction::createCreditTransaction(Transaction::$REFERRAL_WALLET, $this->matrixBonus, $userName, "Registration of $registeredUser");
        // $this->checkMovable($userName);
        // $this->searchMovableUpline($userName);
    }


    public function payLevelBonus($userName, $registeredUser)
    {
        if ($this->stage_id == 0) return;
        Transaction::createCreditTransaction(Transaction::$MATRIX_WALLET, $this->matrixBonus, $userName, "Migration of $registeredUser to Stage $this->stage_id");
        // $this->searchMovableUpline($userName);
        // $this->checkMovable($userName);
    }

    public function payStepoutBonus($userName)
    {
        if (!$this->stepoutBonus) return;
        Transaction::createCreditTransaction(Transaction::$STEP_OUT_WALLET, $this->stepoutBonus, $userName, "For Completion of Stage $this->stage_id");
    }

    public function payStageBonus($userName)
    {
        if (!$this->stageBonus) return;
        Transaction::createCreditTransaction(Transaction::$STAGE_BONUS_WALLET, $this->stageBonus, $userName, "For Completion of Stage $this->stage_id");
    }

    public function payGroupBonus($userName)
    {
        if (!$this->groupBonus) return;
        Transaction::createCreditTransaction(Transaction::$GROUP_BONUS_WALLET, $this->groupBonus, $userName, "For Completion of Stage $this->stage_id");
    }

    public function searchMovableUpline($userName)
    {
        $uplines = Upline::getUplinesFromDb($userName);
        foreach ($uplines as $upline) {
            $uplineUser = User::getUser($upline->upline);
            $uplineStage = Stage::getStage($uplineUser->stage);
            $uplineStage->checkMovable($upline->upline);
        }
    }

    public function checkMovable($userName)
    {
        if ($this->checkStageMigration($userName)) {
            $user = User::getUser($userName);
            $user->enterNextStage();
        }
    }

    public function checkStageMigration($userName)
    {
        if ($this->stage_id == 0) {
            // if (User::getTotalReferrals($userName) < Stage::$NO_OF_LEGS) {
            //     return false;
            // }
            $directDownlines = User::getAllDirectDownlines($userName);
            if (count($directDownlines) < 2) {
                return false;
            }
            foreach ($directDownlines as $key => $user) {
                if (count(User::getAllDirectDownlines($user->userName)) < 2) {
                    return false;
                }
            }
            return true;
        } else {
            $leftDownlines = $this->getAllLeftDownlinesCount($userName);
            $rightDownlines = $this->getAllRightDownlinesCount($userName);
            if ($leftDownlines >= $this->totalDownlines / 2 && $rightDownlines >= $this->totalDownlines / 2) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function processUplinePayments($userName)
    {
        $uplines = $this->getAllUplinesWithinStage($userName);        
        foreach ($uplines as $key => $uplineObj) {
            $upline = $uplineObj->upline;
            $type = Upline::getType($userName, $upline);
            $downlineAmountInStageInfo = StageEntrance::getDownlineAmountInStageInfo($upline, $type, $this->id);
            if ($downlineAmountInStageInfo < ($this->totalDownlines / 2)) {
                if (!StageEntrance::checkStageEntranceInfo($upline, $this->id, $userName, $type)) {
                    $this->payLevelBonus($upline, $userName);
                    $stageEntrance = new StageEntrance();
                    $stageEntrance->stage = $this->id;
                    $stageEntrance->type = $type;
                    $stageEntrance->upline = $upline;
                    $stageEntrance->userName = $userName;
                    $stageEntrance->save();
                }
            }
        }
    }

    public function processDownlinePayments($userName)
    {
        $limit = ($this->totalDownlines / 2);
        $leftDownlines = $this->getAllLeftDownlinesWithLimit($userName, $limit)->toArray();
        $rightDownlines = $this->getAllRightDownlinesWithLimit($userName, $limit)->toArray();
        $allDownlines = array_merge($leftDownlines, $rightDownlines);
        foreach ($allDownlines as $downline) {
            $downlineAmountInStageInfo = StageEntrance::getDownlineAmountInStageInfo($downline->upline, $downline->type, $this->id);
            if ($downlineAmountInStageInfo < ($this->totalDownlines / 2)) {
                if (!StageEntrance::checkStageEntranceInfo($downline->upline, $this->id, $downline->userName, $downline->type)) {
                    $this->payLevelBonus($downline->upline, $downline->userName);
                    $stageEntrance = new StageEntrance();
                    $stageEntrance->stage = $this->id;
                    $stageEntrance->type = $downline->type;
                    $stageEntrance->upline = $downline->upline;
                    $stageEntrance->userName = $downline->userName;
                    $stageEntrance->save();
                }
            }
        }
    }

    public function getAllUplinesWithinStage($userName)
    {
        $uplines = Upline::getAllUplinesWithinStage($userName, $this);
        return $uplines;
    }

    public function getAllDownlinesWithinStage($userName)
    {
        $downlines = Upline::getAllDownlinesWithinStage($userName, $this);
        return $downlines;
    }

    public function processNewStage($userName)
    {
        $this->processUplinePayments($userName);
        $this->processDownlinePayments($userName);
        $this->searchMovableUpline($userName);
        $this->checkMovable($userName);
    }

    public function getAllLeftDownlinesCount($userName)
    {
        $left = Upline::getAllDownlinesCountWithinStageAndLeg($userName, $this, Upline::$LEFT_LEG);
        return $left;
    }

    public function getAllLeftDownlines($userName)
    {
        $left = Upline::getAllDownlinesWithinStageAndLeg($userName, $this, Upline::$LEFT_LEG);
        return $left;
    }

    public function getAllLeftDownlinesWithLimit($userName, $limit)
    {
        $left = Upline::getAllDownlinesWithinStageAndLegWithLimit($userName, $this, Upline::$LEFT_LEG, $limit);
        return $left;
    }

    public function getAllRightDownlinesCount($userName)
    {
        $right = Upline::getAllDownlinesCountWithinStageAndLeg($userName, $this, Upline::$RIGHT_LEG);
        return $right;
    }

    public function getAllRightDownlines($userName)
    {
        $right = Upline::getAllDownlinesWithinStageAndLeg($userName, $this, Upline::$RIGHT_LEG);
        return $right;
    }

    public function getAllRightDownlinesWithLimit($userName, $limit)
    {
        $right = Upline::getAllDownlinesWithinStageAndLegWithLimit($userName, $this, Upline::$RIGHT_LEG, $limit);
        return $right;
    }

    public function createGenealogy($downlines, $index)
    {
        if (isset($downlines[$index])) {
            $downline = $downlines[$index];
            $userName = $downline->userName;
            $id = $userName;
            $name = $userName;
            $user = User::getUser($userName);
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            $stageObj = Stage::getStage($user->stage);
            $stage = $stageObj->stage_id;
            $image = $this->getImageUrl($stage);
            $data = [];
            $data["userType"] = $stage;
            $data["firstName"] = $firstName;
            $data["lastName"] = $lastName;
            $data["image"] = $image;
            $children = $this->getChildren($downlines, $index);
            $genealogy = new Genealogy($id, $name, $data, $children);
            return $genealogy;
        } else {
            if ($index == 0) {
                return $this->createEmptyGenealogy(1);
            } else if ($index == 1 || $index == 2) {
                return $this->createEmptyGenealogy(0);
            } else {
                return $this->createEmptyGenealogy(0);
            }
        }
    }

    public function getNextIndex($index)
    {
        return $index + $index + 1;
    }

    public function getStageGenealogy($activeUser)
    {
        if ($this->stage_id > 0) {
            $leftDownlines = $this->getAllLeftDownlinesWithLimit($activeUser, $this->totalDownlines / 2);
            $rightDownlines = $this->getAllRightDownlinesWithLimit($activeUser, $this->totalDownlines / 2);
            $genealogyData = $this->createGenealogyData($activeUser, $leftDownlines, $rightDownlines);
        } else {
            $genealogyData = $this->createLevel1Genealogy($activeUser);
        }
        return $genealogyData;
    }

    public function getChildren($downlines, $index)
    {
        $startIndex = $this->getNextIndex($index);
        $endIndex = $startIndex + 2;
        $children = array();
        if ($startIndex >= $this->totalDownlines) {
            return $children;
        }
        for ($index1 = $startIndex; $index1 < $endIndex; $index1++) {
            $child = $this->createGenealogy($downlines, $index1);
            array_push($children, $child);
        }
        return $children;
    }

    public function createGenealogyData($userName, $leftDownlines, $rightDownlines)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->createDirectChildren($leftDownlines, $rightDownlines);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getImageUrl($stage)
    {
        return url("images/user$stage.png");
    }

    function createDirectChildren($leftDownlines, $rightDownlines)
    {
        $children = [];
        for ($index = 0; $index < 2; $index++) {
            if ($index == 0) {
                $child = $this->createGenealogy($leftDownlines, 0);
                array_push($children, $child);
            } else {
                $child = $this->createGenealogy($rightDownlines, 0);
                array_push($children, $child);
            }
        }
        return $children;
    }

    public function createLevel1Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getChildrenData($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getChildrenData($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel2Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(1);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    public function createLevel2Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getLevel2Children($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getLevel2Children($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel3Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(0);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    function createLevel3Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getLevel3Children($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    function getLevel3Children($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel4Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(0);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    public function createLevel4Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getLevel4Children($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getLevel4Children($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel5Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(0);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    public function createLevel5Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getLevel5Children($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getLevel5Children($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel6Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(0);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    public function createLevel6Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = $this->getLevel6Children($userName);
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getLevel6Children($userName)
    {
        $directDownlines = User::getAllDirectDownlines($userName);
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            if (isset($directDownlines[$index])) {
                $downline = $directDownlines[$index];
                $genealogy = $this->createLevel7Genealogy($downline->userName);
            } else {
                $genealogy = $this->createEmptyGenealogy(0);
            }
            array_push($children, $genealogy);
        }
        return $children;
    }

    public function createLevel7Genealogy($userName)
    {
        $id = $userName;
        $name = $userName;
        $user = User::getUser($userName);
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $stageObj = Stage::getStage($user->stage);
        $stage = $stageObj->stage_id;
        $image = $this->getImageUrl($stage);
        $data = [];
        $data["userType"] = $stage;
        $data["firstName"] = $firstName;
        $data["lastName"] = $lastName;
        $data["image"] = $image;
        $children = [];
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function createEmptyGenealogy($noOfLevels)
    {
        $id = "a" . rand(1000, 200000);
        $name = "";
        $data = [];
        $data["userType"] = -1;
        $data["image"] = url("images/empty.png");
        if ($noOfLevels == 0) {
            $children = [];
        } else {
            $children = $this->getLevel1EmptyGenealogy($noOfLevels);
        }
        $genealogy = new Genealogy($id, $name, $data, $children);
        return $genealogy;
    }

    public function getLevel1EmptyGenealogy($noOfLevels)
    {
        $children = array();
        for ($index = 0; $index < 2; $index++) {
            $genealogy = $this->createEmptyGenealogy($noOfLevels - 1);
            array_push($children, $genealogy);
        }
        return $children;
    }

    // public static function getTotalUserInFeederStage($plan) {
    //     return Stage::where(["plan" => $plan, "stage_id"=> 0])->count();
    // }

    // public static function getAllUserInFeederStage($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 0])->paginate();
    // }

    // public static function getTotalUserInStageOne($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 1])->count();
    // }

    // public static function getAllUserInStageOne($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 1])->paginate();
    // }

    // public static function getTotalUserInStageTwo($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 2])->count();
    // }

    // public static function getAllUserInStageTwo($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 2])->paginate();
    // }

    //  public static function getTotalUserInStageTwo($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 2])->count();
    // }

    // public static function getAllUserInStageTwo($plan) {
    //     return Stage::where(["plan" => $plan , "stage_id"=> 2])->paginate();
    // }


}
