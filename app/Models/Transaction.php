<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    public static $TRANSACTION_DEBIT = 1;
    public static $TRANSACTION_CREDIT = 2;
    public static $REFERRAL_WALLET = 1;
    public static $RESALE_WALLET = 2;


    public static function createDebitTransaction($wallet, $amount, $userName)
    {
        $transaction = new Transaction();
        $transaction->amount = $amount;
        $transaction->wallet = $wallet;
        $transaction->userName = $userName;
        $transaction->type = Transaction::$TRANSACTION_DEBIT;
        $walletObj = Wallet::getWallet($userName);
        switch ($wallet) {
            case Transaction::$REFERRAL_WALLET:
                if ($walletObj->referralBonus < $amount) {
                    return false;
                }
                $transaction->comment = "A total of $amount NGN has been debited from your Referral Wallet.";
                break;
            case Transaction::$MATRIX_WALLET:
                if ($walletObj->matrixBonus < $amount) {
                    return false;
                }
                $transaction->comment = "A total of $amount NGN has been debited from your Matrix Wallet.";
                break;
            case Transaction::$STAGE_BONUS_WALLET:
                if ($walletObj->stageBonus < $amount) {
                    return false;
                }
                $transaction->comment = "A total of $amount NGN has been debited from your Stage Bonus wallet.";
                break;
            case Transaction::$GROUP_BONUS_WALLET:
                if ($walletObj->groupBonus < $amount) {
                    return false;
                }
                $transaction->comment = "A total of $amount NGN has been debited from your Group Bonus wallet.";
                break;
            case Transaction::$STEP_OUT_WALLET:
                if ($walletObj->stepoutBonus < $amount) {
                    return false;
                }
                $transaction->comment = "A total of $amount NGN has been debited from your Step out wallet.";
                break;
        }
        if ($transaction->save()) {
            $walletObj->updateWallet();
            $notification = new Notification();
            $notification->notification = $transaction->comment;
            $notification->status = 0;
            $notification->title = "DEBIT TRANSACTION ALERT";
            $notification->username = $userName;
            $notification->save();
            return true;
        }
        return false;
    }

    public static function createCreditTransaction($wallet, $amount, $userName, $purpose = null)
    {
        $transaction = new Transaction();
        $transaction->amount = $amount;

        $transaction->wallet = $wallet;
        $transaction->userName = $userName;
        $transaction->type = Transaction::$TRANSACTION_CREDIT;
        $walletObj = Wallet::getWallet($userName);
        switch ($wallet) {
            case Transaction::$REFERRAL_WALLET:
                $purposeString = $purpose ? "on $purpose" : "";
                $transaction->comment = "A total of $amount NGN has been credited into your Referral wallet $purposeString";
                break;
            case Transaction::$MATRIX_WALLET:
                $purposeString = $purpose ? "on $purpose" : "";
                $transaction->comment = "A total of $amount NGN has been credited into your Matrix wallet $purposeString";
                break;
            case Transaction::$STAGE_BONUS_WALLET:
                $purposeString = $purpose ? "on registration of $purpose" : "";
                $transaction->comment = "A total of $amount NGN has been credited into your stage bonus wallet $purposeString";
                break;
            case Transaction::$GROUP_BONUS_WALLET:
                $transaction->comment = "A total of $amount NGN has been credited into your Group Bonus wallet.";
                break;
            case Transaction::$STEP_OUT_WALLET:
                $purposeString = $purpose ? "for finishing Stage $purpose" : "";
                $transaction->comment = "A total of $amount NGN has been credited into your Step out wallet $purposeString";
                break;
        }
        if ($transaction->save()) {
            $walletObj->updateWallet();
            $notification = new Notification();
            $notification->notification = $transaction->comment;
            $notification->status = 0;
            $notification->title = "CREDIT TRANSACTION ALERT";
            $notification->username = $userName;
            $notification->save();
            return true;
        }
        return false;
    }

    public static function getTotalCreditTransaction($userName, $wallet)
    {
        $transactions = Transaction::where("wallet", $wallet)->where("type", Transaction::$TRANSACTION_CREDIT)->where("userName", $userName)->get();
        $totalWallet = 0;
        foreach ($transactions as $transaction) {
            $amount = $transaction->amount;
            $totalWallet += $amount;
        }
        return $totalWallet;
    }

    public static function getTotalDebitTransaction($userName, $wallet)
    {
        $transactions = Transaction::where("wallet", $wallet)->where("type", Transaction::$TRANSACTION_DEBIT)->where("userName", $userName)->get();
        $totalWallet = 0;
        foreach ($transactions as $transaction) {
            $amount = $transaction->amount;
            $totalWallet += $amount;
        }
        return $totalWallet;
    }

}
