@extends('layouts.app')

@section('content')
    <div class="panel panel-default" id="new-deposit">
        <div class="panel-heading">
            {{$client->name . ' ' . $client->surname}}
       </div>
       <div class="panel-body">
           @include('deposit.form', compact('client'))
       </div>
    </div>
    <div class="panel panel-default" >
        <div class="panel-heading">Deposits</div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Percent
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($client->deposits as $deposit)
                    <tr>
                        <td><a href="/deposit/{{$deposit->id}}">{{$deposit->id}}</a></td>
                        <td>{{$deposit->percent}}</td>
                        <td>{{$deposit->amount}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection