@extends('layouts.app')

@section('content')
    <div class="panel panel-default" id="new-client">
        <div class="panel-body">
            @include('client.form')
        </div>
    </div>
    <div class="panel panel-default" id="client-data">
        <div class="panel-heading">Clients</div>
        <div class="panel-body">
            <table class="table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Age
                    </th>
                    <th>
                        Sex
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td><a href="/client/{{$client->id}}">{{$client->id}}</a></td>
                        <td><a href="/client/{{$client->id}}">{{$client->name . ' ' . $client->surname}}</a></td>
                        <td>{{$client->age}}</td>
                        <td>
                            @if($client->sex === 'f') Famale @endif
                            @if($client->sex === 'm') Male @endif
                        </td>
                        <td>
                            {{$client->amount}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    {{$clients->links()}}

@endsection