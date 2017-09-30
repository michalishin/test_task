<form id="new-deposit-form" action="/deposit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="client_id" value="{{$client->id}}">
    <div class="form-group @if($errors->has('sum')) has-error @endif">
        <label for="new-deposit-sum">Sum</label>
        <input class="form-control" name="sum" id="new-deposit-sum" placeholder="Sum">
        @foreach($errors->get('sum') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <div class="form-group @if($errors->has('percent')) has-error @endif">
        <label for="new-deposit-percent">Percent</label>
        <input class="form-control" name="percent" id="new-deposit-percent" placeholder="Percent">
        @foreach($errors->get('percent') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <button type="submit" class="btn btn-default">Add deposit</button>
</form>
