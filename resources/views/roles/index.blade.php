@extends('layouts.app')

@section('content')

    <div class="container">
        <br><br>
        <div class="col-md-12 mx-auto">
            @if (\Session::has('success'))
                <div class="alert alert-danger col-md-4 mx-auto mt-2">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

            <div class="card mt-2">

                <div class="card-header">
                    @can('role.add')
                        <a href="{{ url('roles/create') }}" class="btn btn-outline-dark float-right"><i
                                class="far fa-plus-square "></i></a>
                    @endcan
                    <h1><i class="fas fa-user-tag mt-2 mx-2"></i>{{ __('Roles') }}</h1>
                </div>

                <div class="card-body">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                @can('role.view')
                                    <th>Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $role)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{ $role->id }}">
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('role.edit')
                                            <a class="btn btn-outline-info"
                                                href="{{ url('roles/' . $role->id . '/edit') }}"><i
                                                    class="far fa-edit"></i></a>
                                        @endcan

                                        @can('role.delete')<a style="display: inline-block">
                                                <button class="btn btn-outline-danger" onclick="deleteData('roles/', {{ $role->id }})"><i class="fas fa-trash"></i></button></a>
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
