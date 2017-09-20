<?php

namespace App\Console\Commands;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateDeposit extends CalculateAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:deposit {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate deposit';


    public function getDepositsForCalculate() {
        $this->date = new \DateTime($this->argument('date') ?: 'now');

        $day = $this->getDepositCalcDay();
        return Deposit::where(\DB::raw('DAY(created_at)'),'<=',$day)
            ->where(\DB::raw("DATE_FORMAT(created_at, '%Y-%m' )"),'<',$this->date->format('Y-m'))
            ->whereDoesntHave('transactions', function ($q) {
                $currentMonth = $this->date->format('m');
                $currentYear = $this->date->format('Y');
                $q->whereIn('type_id', [
                    Transaction::INITIAL_TRANSACTION,
                    Transaction::PERCENT_TRANSACTION
                ])->where(\DB::raw('MONTH(date)'),'=',$currentMonth)
                    ->where(\DB::raw('YEAR(date)'),'=',$currentYear);
            })->get();
    }

    public function calculateDeposit(Deposit $deposit)
    {
        $sum = round($deposit->transactions()->sum('amount') * $deposit->percent / 100, 2);
        $deposit->transactions()->create([
            'amount' => $sum,
            'date' => $this->date,
            'type_id' => Transaction::PERCENT_TRANSACTION
        ]);
    }

    protected function getDepositCalcDay () {
        $date = clone $this->date;

        if($date->format('d') !== $date->format('t'))
            return $date->format('d');
        else
            return $date->modify('- 1 month')->format('t');
    }
}
