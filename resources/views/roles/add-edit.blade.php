<?php
$url = url('roles');

if (isset($role['id'])) {
    $url = url('roles/' . $role['id']);
}

?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <br><br>
        <div class="card mt-2">
            <div class="card-header"> 
                
                @include('errors')

                <a class="btn btn-outline-primary mb-2 mt-2 float-right" href="{{ url('roles') }}"> <i
                        class="fas fa-arrow-left"></i></a>
                <h1><i class="fas fa-user-tag mt-2 mx-2"></i>{{ __('Roles') }}</h1>
            </div>
            <form method="post" action="{{ $url }}">
                @csrf

                @if (isset($role['id']))
                    @method('PUT')
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label>Role name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ isset($role['name']) ? $role['name'] : '' }}">
                    </div>

                    <h3>Users</h3>
                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['user.view']) ? 'checked' : '' }} value="user.view">View

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['user.add']) ? 'checked' : '' }} value="user.add">Add

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['user.edit']) ? 'checked' : '' }} value="user.edit">Edit

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['user.delete']) ? 'checked' : '' }} value="user.delete">Delete

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['role.view']) ? 'checked' : '' }} value="role.view">View Role

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['role.add']) ? 'checked' : '' }} value="role.add">Add Role

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['role.edit']) ? 'checked' : '' }} value="role.edit">Edit Role

                    <input type="checkbox" name="permissions[]" class="mx-1"
                        {{ isset($role['role.delete']) ? 'checked' : '' }} value="role.delete">Delete Role

                </div>

                <div class="card-footer"> <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
