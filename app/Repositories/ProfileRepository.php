<?php

namespace App\Repositories;
use App\Models\Profile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Gallery_photos;
use Illuminate\Support\Facades\DB;


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
}

