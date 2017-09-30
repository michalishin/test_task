@extends('layouts.app')

@section('content')
    <div id="client-data">
        {{$client->name . ' ' . $client->surname . ' ' . $client->age}}
        @if($client->sex === 'f') Famale @endif
        @if($client->sex === 'm') Male @endif
    </div>
    <div id="new-deposit">
        @include('deposit.form', compact('client'))
    </div>
    <div id="deposit-data">
        Deposits:
        <ul>
            @foreach($client->deposits as $deposit)
                <ul>
                    <a href="/deposit/{{$deposit->id}}">
                        #{{$deposit->id}}
                        Percent: {{$deposit->percent}}
                        Amount: {{$deposit->amount}}
                    </a>
                </ul>
            @endforeach
        </ul>
    </div>
@endsection