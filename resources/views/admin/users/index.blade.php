@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Permission Valid</th>
                <th>Expiry Date</th>
                <th>Documents</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->access_permission_valid ? 'Valid' : 'Invalid' }}</td>
                <td>{{ $user->permission_expiry_date }}</td>
                <td>
                    @foreach($user->documents as $document)
                    <div class="document-preview">
                        <span>{{ $document->document_type }} - </span>

                        <span>
                            @if($document->is_approved)
                            <span class="badge bg-success">Approved</span>
                            @else
                            Pending
                            @endif
                        </span>
                    </div>
                    @endforeach


                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit Permissions</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection