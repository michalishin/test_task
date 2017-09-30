<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const INITIAL_TRANSACTION = 1;
    const PERCENT_TRANSACTION = 2;
    const SERVICE_TRANSACTION = 3;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
