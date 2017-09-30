@extends('layouts.app')

@section('content')
    <div id="new-client">
        @include('client.form')
    </div>
    <div id="client-data">
        Clients:
        <ul>
           @foreach($clients as $client)
               <ul>
                   <a href="/client/{{$client->id}}">
                       {{$client->name . ' ' . $client->surname . ' ' . $client->age}}
                       @if($client->sex === 'f') Famale @endif
                       @if($client->sex === 'm') Male @endif
                       Amount: {{$client->amount}}
                   </a>
               </ul>
            @endforeach
        </ul>
    </div>
    {{$clients->links()}}

@endsection