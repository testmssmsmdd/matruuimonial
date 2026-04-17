<?php

namespace App\Repositories;
use App\Models\Profile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Gallery_photos;
use App\Models\FavouriteProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProfileRepository implements ProfileRepositoryInterface
{
    public function getProfiles($request, $userId)
    {
        $query = Profile::with('mosals')
            ->where('created_by', $userId);

        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->city)) {
            $query->where('city_id', $request->city);
        }

        if (!empty($request->name)) {
            $s = $request->name;

            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                  ->orWhere('last_name', 'LIKE', "%$s%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                  ->orWhere('caste', 'LIKE', "%$s%")
                  ->orWhere('gotra', 'LIKE', "%$s%");
            });
        }

        return $query->orderBy('id','DESC')->paginate(12);
    }

    public function getCityList($userId)
    {
        return DB::table('cities')
            ->join('profiles', 'cities.id', '=', 'profiles.city_id')
            ->select('cities.name', 'cities.id')
            ->distinct()
            ->get();
    }

    public function getCountries()
    {
        return Country::select('id', 'name')->get();
    }

    public function create($data)
    {
        return Profile::create($data);
    }

    public function storeMosals($profile, $mosals)
    {
        return $profile->mosals()->createMany($mosals);
    }

    public function storeGallery($profile, $data)
    {
        return $profile->gallery_photos()->create($data);
    }

    public function findProfileWithRelations($id)
    {
        return Profile::with(['mosals', 'profile_photo', 'gallery_photo'])
            ->findOrFail($id);
    }

    public function getAllCountries()
    {
        return Country::all();
    }

    public function findById($id)
    {
        return Profile::findOrFail($id);
    }

    public function update($profile, $data)
    {
        return $profile->update($data);
    }

    public function replaceMosals($profile, $mosals)
    {
        $profile->mosals()->delete();
        return $profile->mosals()->createMany($mosals);
    }

    public function getProfileImage($profileId)
    {
        return Gallery_photos::where('profile_id', $profileId)
            ->where('is_profile_photo', 1)
            ->first();
    }

    public function updateProfileImage($profile, $imageName)
    {
        return $profile->profile_photo()->updateOrCreate(
            ['profile_id' => $profile->id, 'is_profile_photo' => 1],
            ['image' => $imageName, 'is_profile_photo' => 1]
        );
    }

    public function findByIdWithRelations($id)
    {
        return Profile::with(['mosals', 'profile_photo', 'gallery_photo'])
            ->findOrFail($id);
    }

    public function deleteProfile($profile)
    {
        // Delete relations first
        $profile->mosals()->delete();
        $profile->profile_photo()->delete();
        $profile->gallery_photo()->delete();

        return $profile->delete();
    }

    public function findDetailsById($id)
    {
        return Profile::with([
                'mosals',
                'profile_photo',
                'gallery_photo',
                'city'
            ])->findOrFail($id);
    }

    public function getStatesByCountry($countryId)
    {
        return State::where('country_id', $countryId)->get();
    }

    public function getCitiesByState($stateId)
    {
        return City::where('state_id', $stateId)->get();
    }

    public function getMosalsByProfile($profileId)
    {
        return Mosal::where('profile_id', $profileId)->get();
    }

    public function findGalleryById($id)
    {
        return Gallery_photos::findOrFail($id);
    }

    public function deleteGallery($image)
    {
        return $image->delete();
    }

    public function toggleStatus($id)
    {
        $profile = Profile::findOrFail($id);

        $profile->profile_status = $profile->profile_status == 1 ? 0 : 1;

        $profile->save();

        return $profile;
    }

    public function getProfileByUserId($userId)
    {
        return Profile::where('created_by', $userId)->first();
    }

    public function createProfile($data)
    {
        return Profile::create($data->all());
    }

    public function updateProfile($data)
    {
        return Profile::where('id', $data->profile_id)->update($data->all());
    }

    public function deleteGalleryImage($id)
    {
        return DB::table('gallery_photos')->where('id', $id)->delete();
    }

    public function toggleFavourite($userId, $profileId)
    {
        $exists = FavouriteProfile::where('user_id', $userId)
            ->where('profile_id', $profileId)
            ->first();

        if ($exists) {
            $exists->delete();
            return ['status' => 'removed', 'message' => 'Removed from favourites'];
        }

        FavouriteProfile::create([
            'user_id' => $userId,
            'profile_id' => $profileId
        ]);

        return ['status' => 'added', 'message' => 'Added to favourites'];
    }

    public function getFavouriteProfiles($userId, Request $request)
    {
        $query = FavouriteProfile::with([
            'profile.profile_photo',
            'profile.city',
            'profile.state'
        ])->where('favourite_profiles.user_id', $userId)
          ->whereHas('profile');

        // Filters
        if (!empty($request->gender)) {
            $query->whereHas('profile', fn($q) => $q->where('gender', $request->gender));
        }

        if (!empty($request->marital_status)) {
            $maritalStatuses = is_array($request->marital_status)
                ? $request->marital_status
                : [$request->marital_status];

            $query->whereHas('profile', fn($q) => $q->whereIn('marital_status', $maritalStatuses));
        }

        if (!empty($request->city)) {
            $cities = is_array($request->city) ? $request->city : [$request->city];
            $query->whereHas('profile', fn($q) => $q->whereIn('city_id', $cities));
        }

        if (!empty($request->name)) {
            $s = $request->name;

            $query->whereHas('profile',function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                  ->orWhere('last_name', 'LIKE', "%$s%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                  ->orWhere('education', 'LIKE', "%{$s}%")
                  ->orWhere('occupation', 'LIKE', "%{$s}%");
            });
        }

        if (!empty($request->min_age)) {
            $query->whereHas('profile', fn($q) => $q->where('age', '>=', $request->min_age));
        }

        if (!empty($request->max_age)) {
            $query->whereHas('profile', fn($q) => $q->where('age', '<=', $request->max_age));
        }

        if (!empty($request->education)) {
            $query->whereHas('profile', fn($q) =>
                $q->where('education', 'LIKE', "%{$request->education}%")
            );
        }

        if (!empty($request->profession)) {
            $query->whereHas('profile', fn($q) =>
                $q->where('occupation', 'LIKE', "%{$request->profession}%")
            );
        }

        if ($request->sort_by == "age") {
            $query->join('profiles', 'favourite_profiles.profile_id', '=', 'profiles.id')
                  ->orderBy('profiles.age', 'asc');
        } elseif ($request->sort_by == "location") {
            $query->join('profiles', 'favourite_profiles.profile_id', '=', 'profiles.id')
                  ->orderBy('profiles.current_address', 'asc');
        } else {
            $query->latest();
        }

        return $query->paginate(12)->appends($request->all());
    }

    public function getFavouriteCities($userId)
    {
        return DB::table('favourite_profiles')
            ->join('profiles', 'favourite_profiles.profile_id', '=', 'profiles.id')
            ->join('cities', 'profiles.city_id', '=', 'cities.id')
            ->where('favourite_profiles.user_id', $userId)
            ->select('cities.id', 'cities.name')
            ->distinct()
            ->get();
    }

    public function getFavouriteProfilesCount($userId, Request $request)
    {
        $query = FavouriteProfile::where('user_id', $userId)
            ->whereHas('profile', function ($q) {
                $q->where('profile_status', 1);
            });

        if (!empty($request->gender)) {
            $query->whereHas('profile', fn($q) => $q->where('gender', $request->gender));
        }

        if (!empty($request->marital_status)) {
            $maritalStatuses = is_array($request->marital_status)
                ? $request->marital_status
                : [$request->marital_status];

            $query->whereHas('profile', fn($q) => $q->whereIn('marital_status', $maritalStatuses));
        }

        if (!empty($request->city)) {
            $cities = is_array($request->city) ? $request->city : [$request->city];
            $query->whereHas('profile', fn($q) => $q->whereIn('city_id', $cities));
        }

        if (!empty($request->name)) {
            $s = $request->name;
            $query->whereHas('profile', function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                    ->orWhere('last_name', 'LIKE', "%$s%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                    ->orWhere('education', 'LIKE', "%{$s}%")
                    ->orWhere('occupation', 'LIKE', "%{$s}%");
            });
        }

        if (!empty($request->min_age)) {
            $query->whereHas('profile', fn($q) => $q->where('age', '>=', $request->min_age));
        }

        if (!empty($request->max_age)) {
            $query->whereHas('profile', fn($q) => $q->where('age', '<=', $request->max_age));
        }

        if (!empty($request->education)) {
            $query->whereHas('profile', fn($q) =>
                $q->where('education', 'LIKE', "%{$request->education}%")
            );
        }

        if (!empty($request->profession)) {
            $query->whereHas('profile', fn($q) =>
                $q->where('occupation', 'LIKE', "%{$request->profession}%")
            );
        }

        return $query->count();
    }
}

