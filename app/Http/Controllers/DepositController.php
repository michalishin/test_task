<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sum' => 'required|numeric|min:0',
            'percent' => 'required|numeric|between:0,100',
            'client_id' => 'required|numeric|exists:clients,id'
        ]);
        DB::transaction(function () use ($request) {
            $deposit = Deposit::create($request->only([
                'percent',
                'client_id'
            ]));

            $deposit->transactions()->create([
                'amount' => $request->sum,
                'type_id' => Transaction::INITIAL_TRANSACTION,
                'date' => Carbon::now()
            ]);
        });
        return redirect('client/' . $request->client_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        $deposit->load('transactions');
        return view('deposit.show', compact('deposit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
