@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Income
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Sum</th>
                </tr>
                </thead>
                <tbody>
                @foreach($income as $item)
                    <tr>
                        <td>
                            {{$item->year . '-' . $item->month}}
                        </td>
                        <td>
                            {{$item->amount}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Statistic
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>18 <= age < 25</th>
                    <th>25 <= age < 50</th>
                    <th>50 <= age</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Sum</td>
                    <td>{{$statisticSum[1]}}</td>
                    <td>{{$statisticSum[2]}}</td>
                    <td>{{$statisticSum[3]}}</td>
                </tr>
                <tr>
                    <td>Count</td>
                    <td>{{$statisticCount[1]}}</td>
                    <td>{{$statisticCount[2]}}</td>
                    <td>{{$statisticCount[3]}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection