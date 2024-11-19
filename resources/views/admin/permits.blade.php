@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-foreground">Admin Dashboard</h1>

        <div class="bg-card rounded-lg shadow-lg border border-border">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-foreground">All Permits</h2>
                <div class="space-y-4">
                    @foreach($permits as $permit)
                        <div class="border border-border rounded p-4 bg-muted">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-foreground">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                    <p class="text-sm text-muted-foreground">User: {{ $permit->user->name }}</p>
                                    <p class="text-sm text-muted-foreground">Status: {{ ucfirst($permit->status) }}</p>
                                    <p class="text-sm text-muted-foreground">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                                </div>
                                @if($permit->status === 'pending')
                                    <form action="{{ route('admin.permits.update', $permit) }}" method="POST" class="flex space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="approved" class="bg-primary text-primary-foreground hover:bg-primary/90 px-3 py-1 rounded text-sm transition-colors">
                                            Approve
                                        </button>
                                        <button type="submit" name="status" value="rejected" class="bg-destructive text-destructive-foreground hover:bg-destructive/90 px-3 py-1 rounded text-sm transition-colors">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @if($permit->documents->count() > 0)
                                <div class="mt-4">
                                    <h4 class="text-sm font-semibold text-foreground">Documents:</h4>
                                    <ul class="list-disc list-inside text-sm">
                                        @foreach($permit->documents as $document)
                                            <li>
                                                <a href="{{ $document->url }}" target="_blank" class="text-primary hover:text-primary/90 hover:underline transition-colors">
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