<form id="new-client-form" action="/client" method="post">
    {{ csrf_field() }}
    <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="new-client-name">Name</label>
        <input class="form-control" name="name" id="new-client-name" placeholder="Name">
        @foreach($errors->get('name') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <div class="form-group @if($errors->has('surname')) has-error @endif">
        <label for="new-client-surname">Surname</label>
        <input class="form-control" name="surname" id="new-client-surname" placeholder="Surname">
        @foreach($errors->get('surname') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <div class="form-group @if($errors->has('date_of_birth')) has-error @endif">
        <label for="new-client-date-of-birth">Date of birth</label>
        <input class="form-control" name="date_of_birth" id="new-client-date-of-birth" placeholder="Date of birth">
        @foreach($errors->get('date_of_birth') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <div class="form-group @if($errors->has('sex')) has-error @endif">
        <div class="radio">
            <label>
                <input type="radio" name="sex" id="new-client-sex" value="f" checked>
                Female
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="sex" id="new-client-sex" value="m">
                Male
            </label>
        </div>
        @foreach($errors->get('sex') as $message)
            <p class="help-block">{{$message}}</p>
        @endforeach
    </div>
    <button type="submit" class="btn btn-default">Add client</button>
</form>
