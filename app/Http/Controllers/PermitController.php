<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermitController extends Controller
{
    public function index()
    {
        $permits = auth()->user()->permits()->with('documents')->get();
        return response()->json($permits);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:access_card,annual_permit',
            'expiry_date' => 'required|date',
        ]);

        $permit = auth()->user()->permits()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return response()->json($permit, 201);
    }

    public function update(Request $request, Permit $permit)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $permit->update($validated);
        return response()->json($permit);
    }

    public function uploadDocument(Request $request, Permit $permit)
    {
        $request->validate([
            'document' => 'required|file|max:10240',
        ]);

        $path = $request->file('document')->store('documents');
        
        $document = $permit->documents()->create([
            'name' => $request->file('document')->getClientOriginalName(),
            'type' => $request->file('document')->getMimeType(),
            'url' => Storage::url($path),
        ]);

        return response()->json($document, 201);
    }
}