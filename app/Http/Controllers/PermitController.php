<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermitController extends Controller
{
    public function index()
    {
        $permits = auth()->user()->permits()->with('documents')->latest()->get();
        return view('permits.index', compact('permits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:access_card,annual_permit',
            'expiry_date' => 'required|date',
        ]);

        auth()->user()->permits()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permit request submitted successfully');
    }

    public function uploadDocument(Request $request, Permit $permit)
    {
        $request->validate([
            'document' => 'required|file|max:10240',
        ]);

        $path = $request->file('document')->store('documents');
        
        $permit->documents()->create([
            'name' => $request->file('document')->getClientOriginalName(),
            'type' => $request->file('document')->getMimeType(),
            'url' => Storage::url($path),
        ]);

        return back()->with('success', 'Document uploaded successfully');
    }
}