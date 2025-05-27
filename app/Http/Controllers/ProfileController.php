<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ActivityUpdate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'department' => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'bio'        => 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'department', 'phone'));

        // Create a snapshot of the user's profile
        $snapshot = "{$user->name} ({$user->email}) ({$user->department}) ({$user->phone})";

        ActivityUpdate::where('user_id', $user->id)
            ->update(['bio_snapshot' => $snapshot]);

        return redirect('/dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
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

        return Redirect::to('/')->with('success', 'Account deleted successfully.');
    }
}
