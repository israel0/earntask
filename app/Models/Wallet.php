<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory, HasUuids;

    public function getBackOfficeBalance()
    {
        return $this->matrixBonus + $this->stageBonus + $this->groupBonus + $this->stepoutBonus + $this->referralBonus;
    }

    public function getLatestWalletBalance($wallet, $userName)
    {
        $totalWalletCredit = Transaction::getTotalCreditTransaction($userName, $wallet);
        $totalWalletDebit = Transaction::getTotalDebitTransaction($userName, $wallet);
        return $totalWalletCredit - $totalWalletDebit;
    }

    public function updateWallet()
    {
        $this->referralWallet = $this->getLatestWalletBalance(Transaction::$REFERRAL_WALLET, $this->userName);
        $this->resaleWallet = $this->getLatestWalletBalance(Transaction::$RESALE_WALLET, $this->userName);
        $this->save();
    }

    public static function getWallet($username)
    {
        $wallet = Wallet::where("userName", $username)->first();
        if ($wallet != null) {
            $wallet->updateWallet();
        } else if (User::checkUsername($username)) {
            $wallet = new Wallet();
            $wallet->userName = $username;
            $wallet->matrixBonus = 0;
            $wallet->groupBonus = 0;
            $wallet->stepoutBonus = 0;
            $wallet->stageBonus = 0;
            $wallet->save();
        }
        return $wallet;
    }
}
