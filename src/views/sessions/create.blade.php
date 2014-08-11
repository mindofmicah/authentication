@section('content')
    @if(Session::has('err'))
        <div class="alert alert-danger">
            {{Session::get('err')}}
        </div>
    @endif

    @if($errors->has())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all('<li>:message</li>')as $message)
                    {{$message}}
                @endforeach
            </ul>
        </div>
    @endif  

<div class="col-xs-12 col-sm-6 col-sm-offset-3">
{{Form::open(['action'=>'SessionsController@store', 'class'=>'well'])}}
<div class="form-group">
    {{Form::label('email', 'Email', ['class'=>'control-label'])}}
    {{form::text('email', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('password', 'Password',['class'=>'contorl-label'])}}
    {{form::password('password', ['class'=>'form-control'])}}
</div>
<div>
{{Form::submit('Sign In', ['class'=>'btn btn-block btn-primary'])}}
</div>
</div>
{{Form::close()}}
@stop
