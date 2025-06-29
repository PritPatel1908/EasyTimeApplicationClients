@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Client Details</h1>
        <div>
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 30%">Name:</th>
                            <td>{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th>Client Code:</th>
                            <td>{{ $client->client_code }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $client->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person:</th>
                            <td>{{ $client->contact_person ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Email:</th>
                            <td>{{ $client->contact_email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Phone:</th>
                            <td>{{ $client->contact_phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($client->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $client->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $client->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Application Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Client Code</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($client->applicationUsers as $appUser)
                                    <tr>
                                        <td>{{ $appUser->client_code }}</td>
                                        <td>{{ $appUser->url ?? 'N/A' }}</td>
                                        <td>
                                            @if($appUser->allow_login)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No application users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
