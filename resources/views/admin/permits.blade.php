@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">All Permits</h2>
                <div class="space-y-4">
                    @foreach($permits as $permit)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                    <p class="text-sm text-gray-600">User: {{ $permit->user->name }}</p>
                                    <p class="text-sm text-gray-600">Status: {{ ucfirst($permit->status) }}</p>
                                    <p class="text-sm text-gray-600">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                                </div>
                                @if($permit->status === 'pending')
                                    <form action="{{ route('admin.permits.update', $permit) }}" method="POST" class="flex space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="approved" class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                                            Approve
                                        </button>
                                        <button type="submit" name="status" value="rejected" class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @if($permit->documents->count() > 0)
                                <div class="mt-4">
                                    <h4 class="text-sm font-semibold">Documents:</h4>
                                    <ul class="list-disc list-inside text-sm">
                                        @foreach($permit->documents as $document)
                                            <li>
                                                <a href="{{ $document->url }}" target="_blank" class="text-blue-500 hover:underline">
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