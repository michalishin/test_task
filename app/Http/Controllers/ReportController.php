<?php

namespace App\Http\Controllers;

use App\Client;
use App\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index () {
        $income = Transaction::groupBy(\DB::raw('MONTH(date), YEAR(date)'))
            ->selectRaw('YEAR(date) as year, MONTH(date) as month, sum(amount) as amount')
            ->orderByRaw('YEAR(date), MONTH(date)')
            ->get();

        $statisticCount = Client::groupBy(\DB::raw('TIMESTAMPDIFF(YEAR,date_of_birth, curdate())'))
            ->join('deposits', 'deposits.client_id', '=', 'clients.id')
            ->selectRaw('TIMESTAMPDIFF(YEAR,date_of_birth, curdate()) as ageOfClient, count(*) as countDeposits')
            ->get()->groupBy(function ($item) {
                if ($item->ageOfClient >= 18 && $item->ageOfClient < 25) return 1;
                if ($item->ageOfClient >= 25 && $item->ageOfClient < 50) return 2;
                if ($item->ageOfClient >= 50 ) return 3;
                return 0;
            })->map(function ($item) {
                return $item->sum('countDeposits');
            });

        $statisticSum = Client::groupBy(\DB::raw('TIMESTAMPDIFF(YEAR,date_of_birth, curdate())'))
            ->join('deposits', 'deposits.client_id', '=', 'clients.id')
            ->join('transactions', 'transactions.deposit_id', '=', 'deposits.id')
            ->selectRaw('TIMESTAMPDIFF(YEAR,date_of_birth, curdate()) as ageOfClient, sum(amount) as sumDeposits')
            ->get()->groupBy(function ($item) {
                if ($item->ageOfClient >= 18 && $item->ageOfClient < 25) return 1;
                if ($item->ageOfClient >= 25 && $item->ageOfClient < 50) return 2;
                if ($item->ageOfClient >= 50 ) return 3;
                return 0;
            })->map(function ($item) {
                return $item->sum('sumDeposits');
            });
        return view('report.index', compact('income', 'statisticCount', 'statisticSum'));
    }
}
