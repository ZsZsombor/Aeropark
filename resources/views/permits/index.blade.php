@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">My Permits</h1>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Request New Permit</h2>
            <form action="{{ route('permits.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Permit Type</label>
                    <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="access_card">Access Card</option>
                        <option value="annual_permit">Annual Permit</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Submit Request
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">My Permits</h2>
                <div class="space-y-4">
                    @foreach($permits as $permit)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">{{ ucfirst(str_replace('_', ' ', $permit->type)) }}</h3>
                                    <p class="text-sm text-gray-600">Status: {{ ucfirst($permit->status) }}</p>
                                    <p class="text-sm text-gray-600">Expires: {{ $permit->expiry_date->format('Y-m-d') }}</p>
                                </div>
                                @if($permit->status === 'pending')
                                    <form action="{{ route('permits.upload-document', $permit) }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                                        @csrf
                                        <input type="file" name="document" class="text-sm">
                                        <button type="submit" class="ml-2 bg-green-500 text-white px-3 py-1 rounded text-sm">
                                            Upload
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