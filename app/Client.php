<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['date_of_birth'];

    public function getAgeAttribute () {
        return $this->date_of_birth->diffForHumans(null, true);
    }

    public function deposits () {
        return $this->hasMany(Deposit::class);
    }

    public function transactions () {
        return $this->hasManyThrough(Transaction::class, Deposit::class);
    }

    public function getAmountAttribute () {
        return $this->transactions()->sum('amount');
    }
}
