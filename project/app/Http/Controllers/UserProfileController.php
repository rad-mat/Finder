<?php

namespace App\Http\Controllers;

use App\Helpers\HasEnsure;
use App\Helpers\LeagueHelper;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    use HasEnsure;


    public function show(Request $request): View | RedirectResponse
    {
        $user = $request->user();
        if (!$user) {
            return Redirect::route('login');
        }

        $profile = $user->profile;
        $path = "assets/profileImages/image_" . $user->id . ".jpg";

        if (!$profile instanceof UserProfile) {
            return Redirect::route('login');
        }
        return view('dashboard', [
            'userProfile' => $profile,
            'profileImagePath' => $path,
            'userLeague' => LeagueHelper::getLeague($profile->league)
        ]);
    }

    public function showUser(int $userId): RedirectResponse | View
    {
        $user = User::find($userId);
        if (!$user || !$user->profile) {
            return Redirect::route('login');
        }

        $path = "assets/profileImages/image_" . $user->id . ".jpg";
        $profile = $user->profile;

        if (!$profile instanceof UserProfile) {
            return Redirect::route('login');
        }
        return view('user.user', [
            'userProfile' => $profile,
            'profileImagePath' => $path,
            'userLeague' => LeagueHelper::getLeague($profile->league)
        ]);
    }
    /**
     * Update the user's profile information.
     */
    public function update(UserProfileUpdateRequest $request): RedirectResponse
    {
        $userProfile = $this->ensureIsNotNullUser($request->user())->profile;
        $data = $this->ensureIsArray($request->validated());
        if ($userProfile instanceof UserProfile) {
            $userProfile->fill($data);
            $userProfile->save();

            if ($request->file('picture') && $request->user() != null && $request->file('picture') instanceof UploadedFile) {
                $image = $request->file('picture');
                $image_name = "image_" . $request->user()->id . ".jpg";
                $image->move(public_path('assets/profileImages'), $image_name);
            }
        }
        return Redirect::route('profile.edit')->with('status', 'userProfile-updated');
    }
}
