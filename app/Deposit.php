<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function client () {
        return $this->belongsTo(Client::class);
    }

    public function transactions () {
        return $this->hasMany(Transaction::class);
    }

    public function getAmountAttribute () {
        return $this->transactions()->sum('amount');
    }
}
