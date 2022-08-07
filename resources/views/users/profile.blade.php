<?php
$user_image = 'image.png';
if (isset($user->image)) {
    $user_image = $user->image;
} ?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        @include('errors')
        <div class="card">
            <div class="card-header">
                <div class="card-header"><a class="btn btn-outline-primary mt-2 mb-2 float-right"
                        href="{{ URL::to('users') }}"> <i class="fas fa-arrow-left"></i></a>
                    <h2><i class="far fa-address-card mt-1"></i>
                        <span class="text-capitalize ">{{ Auth::user()->name }}</span>
                    </h2>
                </div>

                <form action="{{ route('users.profile_update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('Patch')
                    @csrf
                    <div class="card-body">


                        <div class="form-group">
                            <label for="img">Profile image</label><br>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" name="name" value=""
                                placeholder="{{ __('Name') }}">
                        </div>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="{{ __('Email') }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h2><i class="fas fa-unlock-alt"></i>
                    <span class="text-capitalize ">{{ __('Change Password') }}</span>
                </h2>
            </div>

            <form action="{{ route('users.update_password', $user->id) }}" method="post">
                @method('Patch')
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="old_password">{{ __('Old Password') }}</label>
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="{{ __('Old Password') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Password Confirmation') }}</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="{{ __('Password Confirmation') }}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="save" class="btn btn-outline-success">Save</button>
                </div>

            </form>
        </div>

    </div>
@endsection
