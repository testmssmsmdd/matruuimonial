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
            $this->profileservice->createProfile($request);

            return redirect()->back()->with('success', 'Profile created successfully');
        }
    }

    public function update_profile(updateProfileRequest $request,$id)
    {
        $userId = auth()->id();

        $profile = $this->profileservice->getProfileByUserId($userId);
        $request->merge(['profile_id' => $profile->id]);
        $this->profileservice->updateProfile($request);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function deleteGalleryImg(Request $request)
    {
        $this->profileservice->deleteGalleryImage($request->id);
        return response()->json(['message' => 'image deleted successfully','success'=> true]);
    }

    public function favourite_profile(Request $request)
    {
        $userId = auth()->id();

        $exists = FavouriteProfile::where('user_id', $userId)
            ->where('profile_id', $request->profile_id)
            ->first();

        if ($exists) {
            $exists->delete();

            return response()->json([
                'message' => 'Removed from favourites',
                'status' => 'removed'
            ]);
        } else {
            FavouriteProfile::create([
                'user_id' => $userId,
                'profile_id' => $request->profile_id
            ]);

            return response()->json([
                'message' => 'Added to favourites',
                'status' => 'added'
            ]);
        }
    }

    
    public function favourite_profile_list(Request $request)
    {
        $userId = auth()->id();

        $query = FavouriteProfile::with([
            'profile.profile_photo',
            'profile.city',
            'profile.state'
        ])->where('user_id', $userId);

        // Gender filter
        if (!empty($request->gender)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        // Marital Status
        if (!empty($request->marital_status)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('marital_status', $request->marital_status);
            });
        }

        // City
        if (!empty($request->city)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('city_id', $request->city);
            });
        }

        // Age Range
        if (!empty($request->min_age)) {
            $query->whereHas('profile', function ($q) use ($request) {
                if ($request->min_age) {
                    $q->where('age', '>=', $request->min_age);
                }
            });
        }

        if (!empty($request->max_age)) {
            $query->whereHas('profile', function ($q) use ($request) {
                if ($request->max_age) {
                    $q->where('age', '<=', $request->max_age);
                }
            });
        }

        // Name / Religion
        if (!empty($request->name)) {
            $s = $request->name;

            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                  ->orWhere('last_name', 'LIKE', "%$s%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                  ->orWhere('education', 'LIKE', "%$s%")
                  ->orWhere('caste', 'LIKE', "%$s%")
                  ->orWhere('occupation', 'LIKE', "%$s%");
            });
        }


        // Education
        if (!empty($request->education)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('education', 'LIKE', "%{$request->education}%");
            });
        }

        // Profession
        if (!empty($request->profession)) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('occupation', 'LIKE', "%{$request->profession}%");
            });
        }

        // Sorting
        if (!empty($request->sort_by)) {

            if ($request->sort_by == "age") {
                $query->whereHas('profile', function ($q) use ($request) {
                    $q->orderBy('age', 'asc');
                });
            }

            elseif ($request->sort_by == "location") {
                $query->whereHas('profile', function ($q) use ($request) {
                    $q->orderBy('current_address', 'asc');
                });
            }

            elseif ($request->sort_by == "latest") {
                $query->latest();
            }

        } else {
            $query->latest();
        }

        $profilelist = $query->orderBy('id', 'desc')->paginate(12)->appends($request->all());

        // City list
        $cityList = DB::table('favourite_profiles')
            ->join('profiles', 'favourite_profiles.profile_id', '=', 'profiles.id')
            ->join('cities', 'profiles.city_id', '=', 'cities.id')
            ->where('favourite_profiles.user_id', $userId)
            ->select('cities.id', 'cities.name')
            ->distinct()
            ->get();

        return view('users.profile.favourite_profile', compact('profilelist', 'cityList'));
    }

        
}
