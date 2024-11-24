@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">All Permits</h2>
            <div class="list-group">
                @foreach($permits as $permit)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="h5 mb-1">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                <p class="mb-1">User: {{ $permit->user->name }}</p>
                                <p class="mb-1">Status: {{ ucfirst($permit->status) }}</p>
                                <p class="mb-1">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                            </div>
                            @if($permit->status === 'pending')
                                <form action="{{ route('admin.permits.update', $permit) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="approved" class="btn btn-success btn-sm">
                                        Approve
                                    </button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">
                                        Reject
                                    </button>
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection