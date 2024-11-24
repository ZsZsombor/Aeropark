@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">My Permits</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Request New Permit</h2>
            <form action="{{ route('permits.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Permit Type</label>
                    <select name="type" class="form-select">
                        <option value="access_card">Access Card</option>
                        <option value="annual_permit">Annual Permit</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">My Permits</h2>
            @foreach($permits as $permit)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="h5">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                <p class="mb-1">Status: {{ ucfirst($permit->status) }}</p>
                                <p class="mb-1">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                            </div>
                            @if($permit->status === 'pending')
                                <form action="{{ route('permits.upload-document', $permit) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                                    @csrf
                                    <input type="file" name="document" class="form-control form-control-sm">
                                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                </form>
                            @endif
                        </div>
                        @if($permit->documents->count() > 0)
                            <div class="mt-3">
                                <h4 class="h6">Documents:</h4>
                                <ul class="list-unstyled">
                                    @foreach($permit->documents as $document)
                                        <li>
                                            <a href="{{ $document->url }}" target="_blank" class="text-primary">
                                                {{ $document->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection