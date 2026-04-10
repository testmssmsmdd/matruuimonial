<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\updateProfileRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Profile;
use App\Models\Mosal;
use App\Models\Gallery_photos;
use App\Models\FavouriteProfile;
use DB;
use Auth;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileservice){}

    public function create_profie()
    {
        $profile = $this->profileservice->getProfileByUserId(auth()->id());

        $data = $this->profileservice->getCreateData();
        $data['profile'] = $profile;
        return view('users.profile.create_profile', $data);
    }

    public function store_profile(StoreProfileRequest $request)
    {
        $userId = auth()->id();

        $profile = $this->profileservice->getProfileByUserId($userId);

        if ($profile) {
            $request->merge(['profile_id' => $profile->id]);
            $this->profileservice->updateProfile($request);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            $this->profileservice->createFavProfile($request);

            return redirect()->back()->with('success', 'Profile created successfully');
        }
    }

    public function update_profile(updateProfileRequest $request,$id)
    {
        $userId = auth()->id();

        $profile = $this->profileservice->getProfileByUserId($userId);
        $request->merge(['profile_id' => $profile->id]);
        $this->profileservice->updateFavProfile($request);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function deleteGalleryImg(Request $request)
    {
        $this->profileservice->deleteGalleryImage($request->id);
        return response()->json(['message' => 'image deleted successfully','success'=> true]);
    }

    public function favourite_profile(Request $request)
    {
        $result = $this->profileservice->toggleFavourite(auth()->id(), $request->profile_id);

        return response()->json($result);
    }

    public function favourite_profile_list(Request $request)
    {
        $userId = auth()->id();

        $profilelist = $this->profileservice->getFavouriteProfiles($userId, $request);
        $cityList = $this->profileservice->getFavouriteCities($userId);

        return view('users.profile.favourite_profile', compact('profilelist', 'cityList'));
    }

        
}
