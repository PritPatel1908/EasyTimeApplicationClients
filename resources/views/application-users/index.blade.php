@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Application Users</h1>
        <a href="{{ route('application-users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Application User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Application User List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Client Code</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicationUsers as $appUser)
                            <tr>
                                <td>{{ $appUser->id }}</td>
                                <td>{{ $appUser->client->name ?? 'N/A' }}</td>
                                <td>{{ $appUser->client_code }}</td>
                                <td>{{ $appUser->url ?? 'N/A' }}</td>
                                <td>
                                    @if($appUser->allow_login)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('application-users.show', $appUser) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('application-users.edit', $appUser) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('application-users.destroy', $appUser) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this application user?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No application users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $applicationUsers->links() }}
        </div>
    </div>
</div>
@endsection
