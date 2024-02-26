<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory, HasUuids;

    public static $CODE_ACTIVATED = 1;
    public static $COMPANY_ACTIVATED = 2;
    public static $USER_ACTIVATED = 3;
}
