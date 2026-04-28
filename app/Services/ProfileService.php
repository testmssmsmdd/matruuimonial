<?php

namespace App\Services;
use Auth;
use DB;
use App\Models\Profile;
use App\Models\FavouriteProfile;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileService
{
    protected $profileRepository;


    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }


    public function getProfileList($request)
    {
        $userId = Auth::id();

        $profilelist = $this->profileRepository->getProfiles($request, $userId);
        $cityList = $this->profileRepository->getCityList($userId);

        return compact('profilelist', 'cityList');
    }

    public function getCreateData()
    {
        $countries = $this->profileRepository->getCountries();

        return compact('countries');
    }

    public function createProfile($request)
    {
        $validated = $request->validated();
        return DB::transaction(function () use ($validated, $request) {

            $mosals = $validated['mosal'] ?? [];
            unset($validated['mosal']);

            $mosals = array_filter($mosals, function ($mosal) {
                return !empty($mosal['person_name']) || !empty($mosal['contact_number']);
            });

            $validated['user_id'] = auth()->user()->role === 'Admin'
                ? $request->user_id
                : auth()->id();

            $validated['created_by'] = auth()->id();

            $validated['height'] = $request->height_ft . '.' . $request->height_in;
            unset($validated['height_ft'], $validated['height_in']);

            $validated['birth_time'] = $request->birth_hours.':'.$request->birth_minutes.' '.$request->birth_format;
            unset($validated['birth_hours'], $validated['birth_minutes'], $validated['birth_format']);

            if (Auth::user()->role === 'User') {
                $validated['profile_status'] = 1;
            }

            $profile = $this->profileRepository->create($validated);

            if (!empty($mosals)) {
                $this->profileRepository->storeMosals($profile, $mosals);
            }

            $this->handleImages($request, $profile);

            return $profile;
        });
    }

    private function handleImages($request, $profile)
    {
        if ($request->hasFile('profile_photo')) {

            $imageName = time().'_'.rand(1,1000).'.'.$request->profile_photo->extension();

            $request->profile_photo->move(public_path('profile_photos'), $imageName);

            $this->profileRepository->storeGallery($profile, [
                'image' => $imageName,
                'is_profile_photo' => 1,
            ]);
        }

        // Gallery photos
        if ($request->hasFile('gallery_photo')) {
            foreach ($request->file('gallery_photo') as $image) {

                $imageName = time().'_'.rand(1,1000).'.'.$image->extension();

                $image->move(public_path('gallery_photo'), $imageName);

                $this->profileRepository->storeGallery($profile, [
                    'image' => $imageName,
                    'is_profile_photo' => 0,
                ]);
            }
        }
    }

    public function getEditData($id)
    {
        $profile = $this->profileRepository->findProfileWithRelations($id);
        $countries = $this->profileRepository->getAllCountries();

        return compact('profile', 'countries');
    }

    public function updateProfile($request)
    {
        $id = $request->profile_id;
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $request, $id) {

            $profile = $this->profileRepository->findById($id);

            $mosals = $validated['mosal'] ?? [];
            unset($validated['mosal']);

            $mosals = array_filter($mosals, function ($mosal) {
                return !empty($mosal['person_name']) || !empty($mosal['contact_number']);
            });

            $validated['birth_time'] = $request->birth_hours.':'.$request->birth_minutes.' '.$request->birth_format;
            unset($validated['birth_hours'], $validated['birth_minutes'], $validated['birth_format']);

            $validated['height'] = $request->height_ft . '.' . $request->height_in;
            unset($validated['height_ft'], $validated['height_in']);

            $this->profileRepository->update($profile, $validated);

            if (!empty($mosals)) {
                $this->profileRepository->replaceMosals($profile, $mosals);
            } else {
                $profile->mosals()->delete();
            }

            if (Auth::user()->role === 'User') {
                $data['profile_status'] = 1;
            }

            // Handle images
            $this->handleProfileImage($request, $profile);
            $this->handleGalleryImages($request, $profile);

            return $profile;
        });
    }

    private function handleProfileImage($request, $profile)
    {
        if ($request->hasFile('profile_photo')) {

            $oldImage = $this->profileRepository->getProfileImage($profile->id);

            if ($oldImage && file_exists(public_path('profile_photos/'.$oldImage->image))) {
                unlink(public_path('profile_photos/'.$oldImage->image));
            }

            $imageName = time().'_'.rand(1,1000).'.'.$request->profile_photo->extension();

            $request->profile_photo->move(public_path('profile_photos'), $imageName);

            $this->profileRepository->updateProfileImage($profile, $imageName);
        }
    }

    private function handleGalleryImages($request, $profile)
    {
        if ($request->hasFile('gallery_photo')) {

            foreach ($request->file('gallery_photo') as $image) {

                $imageName = time().'_'.rand(1,1000).'.'.$image->extension();

                $image->move(public_path('gallery_photo'), $imageName);

                $this->profileRepository->storeGallery($profile, [
                    'image' => $imageName,
                    'is_profile_photo' => 0,
                ]);
            }
        }
    }

    public function deleteProfile($id)
    {
        return DB::transaction(function () use ($id) {

            $profile = $this->profileRepository->findByIdWithRelations($id);

            // Delete profile image
            $this->deleteProfileImage($profile);

            // Delete gallery images
            $this->deleteGalleryImages($profile);

            // Delete DB records
            $this->profileRepository->deleteProfile($profile);

            return true;
        });
    }

    private function deleteProfileImage($profile)
    {
        $image = $profile->profile_photo;

        if ($image && file_exists(public_path('profile_photos/'.$image->image))) {
            unlink(public_path('profile_photos/'.$image->image));
        }
    }

    private function deleteGalleryImages($profile)
    {
        foreach ($profile->gallery_photo as $gallery) {

            if ($gallery && file_exists(public_path('gallery_photo/'.$gallery->image))) {
                unlink(public_path('gallery_photo/'.$gallery->image));
            }
        }
    }


    public function getProfileDetails($id)
    {
        return $this->profileRepository->findDetailsById($id);
    }

    public function getStates($countryId)
    {
        return $this->profileRepository->getStatesByCountry($countryId);
    }

    public function getCities($stateId)
    {
        return $this->profileRepository->getCitiesByState($stateId);
    }

    public function getMosals($profileId)
    {
        return $this->profileRepository->getMosalsByProfile($profileId);
    }

    public function deleteGalleryImage($id)
    {
        return DB::transaction(function () use ($id) {

            $image = $this->profileRepository->findGalleryById($id);

            // Delete file
            if ($image && file_exists(public_path('gallery_photo/'.$image->image))) {
                unlink(public_path('gallery_photo/'.$image->image));
            }

            // Delete DB record
            return $this->profileRepository->deleteGallery($image);
        });
    }

    public function changeStatus($id)
    {
        return $this->profileRepository->toggleStatus($id);
    }

    public function getProfileByUserId($userId)
    {
        return $this->profileRepository->getProfileByUserId($userId);
    }

    public function createFavProfile($request)
    {
        return $this->profileRepository->createProfile($request);
    }

    public function updateFavProfile($request)
    {
        return $this->profileRepository->updateProfile($request);
    }

    public function toggleFavourite($userId, $profileId)
    {
        return $this->profileRepository->toggleFavourite($userId, $profileId);
    }

    public function getFavouriteProfiles($userId, Request $request)
    {
        return $this->profileRepository->getFavouriteProfiles($userId, $request);
    }

    public function getFavouriteCities($userId)
    {
        return $this->profileRepository->getFavouriteCities($userId);
    }

    public function getFavouriteProfilesData($userId, Request $request)
    {
        $profilelist = $this->profileRepository->getFavouriteProfiles($userId, $request);
        $cityList = $this->profileRepository->getFavouriteCities($userId);
        $favouriteProfilesCount = $this->profileRepository->getFavouriteProfilesCount($userId, $request);
        return compact('profilelist', 'cityList', 'favouriteProfilesCount');
    }

    public function hardDeleteUserProfile($profileId, $userId)
    {
        return DB::transaction(function () use ($profileId, $userId) {
            $profile = $this->profileRepository->findUserOwnedProfileWithRelations($profileId, $userId);

            if (!$profile) {
                throw ValidationException::withMessages([
                    'id' => ['Profile not found or unauthorized action.'],
                ]);
            }

            $this->deleteProfileImage($profile);
            $this->deleteGalleryImages($profile);
            $this->profileRepository->deleteProfileFavourites($profile->id);
            $this->profileRepository->hardDeleteProfile($profile);

            return true;
        });
    }
}