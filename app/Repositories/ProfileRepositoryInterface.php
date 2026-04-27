<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface ProfileRepositoryInterface
{
    public function getProfiles($request, $userId);
    
    public function getCityList($userId);

    public function getCountries();

    public function create($data);
    
    public function storeMosals($profile, $mosals);
    
    public function storeGallery($profile, $data);

    public function findProfileWithRelations($id);

    public function getAllCountries();

    public function findById($id);
    
    public function update($profile, $data);

    public function replaceMosals($profile, $mosals);
    
    public function getProfileImage($profileId);
    
    public function updateProfileImage($profile, $imageName);
    
    // public function storeGallery($profile, $data);

    public function findByIdWithRelations($id);

    public function deleteProfile($profile);

    public function findDetailsById($id);

    public function getStatesByCountry($countryId);

    public function getCitiesByState($stateId);

    public function getMosalsByProfile($profileId);

    public function findGalleryById($id);

    public function deleteGallery($image);

    public function getProfileByUserId($userId);
    public function createProfile($data);
    public function updateProfile($data);
    public function deleteGalleryImage($id);

    public function toggleFavourite($userId, $profileId);
    public function getFavouriteProfiles($userId, Request $request);
    public function getFavouriteCities($userId);
    public function findUserOwnedProfileWithRelations($profileId, $userId);
    public function hardDeleteProfile($profile);
    public function deleteProfileFavourites($profileId);

}