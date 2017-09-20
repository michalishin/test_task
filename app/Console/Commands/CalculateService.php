<?php

namespace App\Console\Commands;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Console\Command;

class CalculateService extends CalculateAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:service {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate deposit';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->date = new \DateTime($this->argument('date') ?: 'now');

        if ($this->date->format('d') != 1) return;
        parent::handle();
    }

    function getDepositsForCalculate()
    {
        $currentMonth = $this->date->format('m');
        $currentYear = $this->date->format('Y');
        return Deposit::where(\DB::raw("DATE_FORMAT(created_at, '%Y-%m' )"),'<',$this->date->format('Y-m'))
            ->whereDoesntHave('transactions', function ($q) {
                $currentMonth = $this->date->format('m');
                $currentYear = $this->date->format('Y');
                $q->whereIn('type_id', [
                    Transaction::SERVICE_TRANSACTION
                ])->where(\DB::raw('MONTH(date)'),'=',$currentMonth)
                    ->where(\DB::raw('YEAR(date)'),'=',$currentYear);
            })->get();
    }

    function calculateDeposit(Deposit $deposit)
    {
        $sum = $deposit->transactions()->sum('amount');
        if ($sum < 1000) {
            $percent = 5;
            $maxCommission = 50;
        } else if ($sum >= 1000 && $sum < 10000 ) {
            $percent = 6;
            $maxCommission = 10000 * $percent / 100;
        } else {
            $percent = 7;
            $maxCommission = 5000;
        }
        $coefficient = 1;
        if ($this->date->format('m') - 1 == $deposit->created_at->format('m')) {
            $daysInPrevMonth = $deposit->created_at->format('t') - $deposit->created_at->format('d') + 1;
            $coefficient = $daysInPrevMonth / $deposit->created_at->format('t');
        }
        $serviceSum = $sum * $percent / 100 * $coefficient;
        $serviceSum = $serviceSum < $maxCommission ? $serviceSum : $maxCommission;
        $deposit->transactions()->create([
            'amount' => - $serviceSum,
            'date' => $this->date,
            'type_id' => Transaction::SERVICE_TRANSACTION
        ]);
    }


}
