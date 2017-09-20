@extends('layouts.app')

@section('content')
    <div class="panel panel-default" id="deposit-data">
        <div class="panel-heading">
            #{{$deposit->id}} - {{$deposit->amount}}
        </div>
        <div class="panel-body">
            <h1>Deposits</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($deposit->transactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->date}}</td>
                        <td>{{$transaction->amount}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection