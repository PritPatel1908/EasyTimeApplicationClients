@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Application User</h1>
        <a href="{{ route('application-users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Application User Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('application-users.update', $applicationUser) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id">Client <span class="text-danger">*</span></label>
                            <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                                <option value="">-- Select Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $applicationUser->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} ({{ $client->client_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_code">Client Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('client_code') is-invalid @enderror" id="client_code" name="client_code" value="{{ old('client_code', $applicationUser->client_code) }}" required>
                            @error('client_code')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $applicationUser->url) }}">
                            @error('url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allow_login" name="allow_login" value="1" {{ old('allow_login', $applicationUser->allow_login) ? 'checked' : '' }}>
                            <label class="form-check-label" for="allow_login">
                                Allow Login
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Application User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
