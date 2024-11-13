<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update user name and email if present
        $user->fill($request->validated());

        // Reset email verification if the email was changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the updated user data
        $user->save();

        return Redirect::route('dashboard')->with('status', 'Profile updated successfully!');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Handle avatar upload if present
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();

            // Set a success message in the session
            return redirect()->back()->with('status', 'avatar-updated');
        }

        return redirect()->back()->withErrors(['avatar' => 'Please upload a valid image.']);
    }

    /**
     * Remove the user's avatar.
     */
    public function removeAvatar(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Remove the avatar file from storage if it exists
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // Set the avatar field to null
        $user->avatar = null;
        $user->save();

        return redirect()->back()->with('removed-status', 'Avatar removed successfully.');
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

        return Redirect::to('/');
    }


    public function updatePassword(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' ensures the new password matches the confirmation
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Password updated successfully.');
    }

}
