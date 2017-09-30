@extends('layouts.app')

@section('content')
    <div id="deposit-data">
        #{{$deposit->id}}
        Percent: {{$deposit->percent}}
        Amount: {{$deposit->amount}}
    </div>
    <div id="transactions-data">
        Transactions:
        <ul>
            @foreach($deposit->transactions as $transaction)
                <li>
                    #{{$transaction->id}} Amount: {{$transaction->amount}} Date: {{$transaction->created_at}}
                </li>
            @endforeach
        </ul>
    </div>
@endsection