<?php

namespace App\Console\Commands;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

abstract  class CalculateAbstract extends Command
{
    public function handle()
    {
        $this->getDepositsForCalculate()->each(function ($deposit) {
            $this->calculateDeposit($deposit);
        });
    }

    abstract function getDepositsForCalculate ();
    abstract function calculateDeposit (Deposit $deposit);
}
