@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-foreground">My Permits</h1>

        <div class="bg-card rounded-lg shadow-lg border border-border p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-foreground">Request New Permit</h2>
            <form action="{{ route('permits.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-foreground">Permit Type</label>
                    <select name="type" class="mt-1 block w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary">
                        <option value="access_card">Access Card</option>
                        <option value="annual_permit">Annual Permit</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-foreground">Expiry Date</label>
                    <input type="date" name="expiry_date" class="mt-1 block w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <button type="submit" class="bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded transition-colors">
                    Submit Request
                </button>
            </form>
        </div>

        <div class="bg-card rounded-lg shadow-lg border border-border">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-foreground">My Permits</h2>
                <div class="space-y-4">
                    @foreach($permits as $permit)
                        <div class="border border-border rounded p-4 bg-muted">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-foreground">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                    <p class="text-sm text-muted-foreground">Status: {{ ucfirst($permit->status) }}</p>
                                    <p class="text-sm text-muted-foreground">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                                </div>
                                @if($permit->status === 'pending')
                                    <form action="{{ route('permits.upload-document', $permit) }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                                        @csrf
                                        <input type="file" name="document" class="text-sm text-foreground">
                                        <button type="submit" class="ml-2 bg-primary text-primary-foreground hover:bg-primary/90 px-3 py-1 rounded text-sm transition-colors">
                                            Upload
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