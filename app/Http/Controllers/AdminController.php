<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

  


    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function editUserPermissions(User $user)
    {
        $documents = $this->getUploadedDocuments($user);
        return view('admin.users.edit', compact('user', 'documents'));
    }

    public function getUploadedDocuments(User $user)
    {
        return $user->documents()->latest()->get();
    }
    
    public function showUploadedDocumentsForAdmin(User $user)
    {
        $documents = $this->getUploadedDocuments($user);
        return view('admin.users.edit', compact('user', 'documents'));
        
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $request->validate([
            'access_permission_valid' => 'required|boolean',
            'permission_expiry_date' => 'nullable|date|after:today', 
        ]);

        $user->update([
            'access_permission_valid' => $request->access_permission_valid,
            'permission_expiry_date' => $request->permission_expiry_date,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User permissions updated!');
    }




    public function showRegistrationForm()
    {
        return view('admin.users.register');
    }


    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User registered successfully.');
    }
}
