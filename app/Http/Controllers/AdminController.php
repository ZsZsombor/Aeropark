<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $permits = Permit::with(['user', 'documents'])->latest()->get();
        return view('admin.permits', compact('permits'));
    }

    public function update(Request $request, Permit $permit)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $permit->update($validated);

        return back()->with('success', 'Permit status updated successfully');
    }
}