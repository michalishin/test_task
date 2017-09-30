<?php

namespace App\Console\Commands;

use App\Deposit;
use App\Transaction;
use Illuminate\Console\Command;

class CalculateDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate deposit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $day = $this->getDepositCalcDay();
        $currentMonth = (new \DateTime())->format('m');
        $deposits =
            Deposit::where(\DB::raw('DAY(created_at)'),'<=',$day)
                ->whereDoesntHave('transactions', function ($q) use ($currentMonth) {
                    $q->whereIn('transaction_type_id', [
                        Transaction::INITIAL_TRANSACTION,
                        Transaction::PERCENT_TRANSACTION
                    ])->where(\DB::raw('MONTH(created_at)'),'=',$currentMonth);
                })
                ->with('transactions')->get();
        dd($deposits->toArray());
    }

    public function getDepositCalcDay () {
        $date = new \DateTime();
        if($date->format('d') !== $date->format('t'))
            return $date->format('d');

        return $date->modify('- 1 month')->format('t');
    }
}
