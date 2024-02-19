@extends('layouts.main')
@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Permissions</h2>
        <div class="lead">
            Manage permissions here.
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
        </div>

        <div class="mt-2">
            {{-- @include('layouts.partials.messages') --}}
        </div>

        <table class="table table-striped dataTable" id="dataTable">
            <thead>
                <tr>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Group</th>
                    <th scope="col"width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>{{ $permission->group_name }}</td>
                        <td>
                            <div class="skip d-flex justify-content-center">
                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                {{-- {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['permissions.destroy', $permission->id],
                                    'style' => 'display:inline',
                                ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!} --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $permissions->links() }} --}}
    </div>
@endsection
