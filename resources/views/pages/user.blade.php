@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <div class="card col-xs-12">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title">Users</h4>
                        </div>
                    </div> <!-- / .row -->
                </div>
                <div class="card-body">
                    @if(isset($users) && !empty($users))
                    <table id="table-users" class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Type</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr id="user-{{ $user->id }}" class="user">
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->fullname }}</td>
                                <td>
                                @if($user->type == 1)
                                    Client
                                @elseif($user->type == 2)
                                    Employees
                                @elseif($user->type == 3)
                                    Subcontractors
                                @endif
                                </td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $users->render() !!}
                    @else
                        <h3>No user found.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
