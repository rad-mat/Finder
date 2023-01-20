<?php

namespace App\Http\Controllers;

use App\Helpers\HasEnsure;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use HasEnsure;

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View | RedirectResponse
    {
        $user = $request->user();
        if (!$user) {
            return Redirect::route('login');
        }
        $profile = $user->profile;

        if (!$profile) {
            return Redirect::route('login');
        }
        $profileImagePath = "assets/profileImages/image_" . $user->id . ".jpg";

        return view('profile.edit', [
            'user' => $user,
            'userProfile' => $profile,
            'profileImagePath' => $profileImagePath
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $this->ensureIsNotNullUser($request->user());
        $data = $this->ensureIsArray($request->validated());

        if ($user->email != $data['email']) {
            $user->email_verified_at = null;
        }

        $user->fill($data);
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $this->ensureIsNotNullUser($request->user());

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
