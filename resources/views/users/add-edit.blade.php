<?php
$url = url('users');

if (isset($user['id'])) {
    $url = url('users/' . $user['id']);
}

?>
@extends('layouts.app')

@section('content')

    <div class="container">
        <br><br>
        <div class="card mt-2">
            <div class="card-header"> @include('errors')
                <a class="btn btn-outline-primary mb-2 mt-2 float-right" href="{{ url('users') }}"> <i
                        class="fas fa-arrow-left"></i></a>
                <h1><i class="fas fa-users mt-2 mx-2"></i>{{ __('Users') }}</h1>
            </div>
            <h1></h1>
            <form method="post" action="{{ $url }}">
                @csrf
                @if (isset($user['id']))
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="card-body">

                        <div class="form-group">
                            {!! Form::label('name', 'User Name:') !!}
                            {!! Form::text('name', isset($user) ? $user->name : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::email('email', isset($user) ? $user->email : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password:') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('confirm-password', 'Confirm Password:') !!}
                            {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('roles', 'Roles:') !!}
                            {!! Form::select('roles', $roles, isset($user) ? $user->getRoleNames()[0] : null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <div class="card-footer"> <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dd70c8c1dcdaeabd22ee', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('test'->user()->id);
    channel.bind('new-user', function(data) {
        alert(JSON.stringify(data));
    });

</script>
