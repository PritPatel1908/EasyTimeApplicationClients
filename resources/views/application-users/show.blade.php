@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Application User Details</h1>
        <div>
            <a href="{{ route('application-users.edit', $applicationUser) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('application-users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Application User Information</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 30%">Client:</th>
                            <td>
                                <a href="{{ route('clients.show', $applicationUser->client_id) }}">
                                    {{ $applicationUser->client->name ?? 'N/A' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Client Code:</th>
                            <td>{{ $applicationUser->client_code }}</td>
                        </tr>
                        <tr>
                            <th>URL:</th>
                            <td>
                                @if($applicationUser->url)
                                    <a href="{{ $applicationUser->url }}" target="_blank">
                                        {{ $applicationUser->url }}
                                        <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($applicationUser->allow_login)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $applicationUser->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $applicationUser->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
