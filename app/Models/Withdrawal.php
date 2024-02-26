<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory, HasUuids;

    public static $WITHDRAW_AVAILABLE = 1;
    public static $WITHDRAW_TOTAL_PAID_OUT = 2;

    protected $fillable = [
        "wallet", "withdrawalStatus", "userName", "amount", "withdrawTo", "bankName", "bankAccountNumber", "bankAccountName"
    ];

    public static function getAllWithdrawals($search = "")
    {
        if (!empty($search)) {
            return Withdrawal::where("userName", "REGEXP", $search)->paginate(100);            
        } else {
            return Withdrawal::paginate(100);
        }
    }

    public static function getTotalWithdrawals($search = "")
    {
        if (!empty($search)) {
            return Withdrawal::where("userName", "REGEXP", $search)->count();            
        } else {
            return Withdrawal::count();
        }        
    }
}
