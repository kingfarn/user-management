@extends('layouts.app')

@section('content')

    <div class="container">
        <br><br>
        <div class="col-md-12 mx-auto">
            <div class="card mt-2">
                <div class="card-header">

                    @can('role.add')
                        <a href="{{ url('users/create') }}" class="btn btn-outline-dark float-right"><i
                                class="far fa-plus-square "></i></a>
                    @endcan

                    <h1><i class="fas fa-users mt-2 mx-2"></i>{{ __('Users') }}</h1>
                </div>

                <div class="card-body ">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th><b>ID</b></th>
                                <th><b>Name</b></th>
                                <th><b>Email</b></th>
                                <th><b>Roles</b></th>
                                <th><b>Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $i=1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{ $user->id }}">
                                    <td>{{$i++}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $roleName)
                                                <label class="badge badge-success">{{ $roleName }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('user.edit')
                                            <a class="btn btn-outline-info" href="{{ url('users/' . $user->id . '/edit') }}"><i
                                                    class="far fa-edit"></i></a>
                                        @endcan
                                        @can('user.delete')
                                            <a style="display: inline-block">
                                                <button class="btn btn-outline-danger"
                                                    onclick="deleteData('users/',{{ $user->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
