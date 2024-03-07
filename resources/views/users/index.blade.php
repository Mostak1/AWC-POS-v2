@extends('layouts.main')
@section('content')
    <div class="bg-white p-4 rounded-4 shadow-lg mb-5 bg-body-tertiary">
        <h1>Users</h1>
        <div class="lead">
            Manage users here.
        </div>
        
        <div class="mt-2">
            {{-- @include('layouts.partials.messages') --}}
        </div>

        <table class="table table-striped" id="dataTable">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Username</th>
              
                <th scope="col" width="1%" >Action</th>    
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                       
                        <td>
                            <div class="skip d-flex justify-content-center">
                                
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
         
        </div>

    </div>
@endsection