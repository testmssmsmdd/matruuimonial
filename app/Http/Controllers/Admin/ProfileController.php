<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\updateProfileRequest;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Profile;
use App\Models\Mosal;
use App\Models\Gallery_photos;
use DB;
use Auth;
use App\Services\ProfileService;


class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileservice){}
    
    public function list(Request $request)
    {
        $data = $this->profileservice->getProfileList($request);

        return view('admin.profile.list', $data);
    }

    public function create()
    {
         $data = $this->profileservice->getCreateData();
         return view('admin.profile.create', $data);
    }

    public function store(StoreProfileRequest $request)
    {
        $this->profileservice->createProfile($request);
        return to_route('admin.list')->with('success', 'The profile is saved successfully');
    }


    public function edit($id)
    {
        $data = $this->profileservice->getEditData($id);
        return view('admin.profile.edit', $data);
    }

    public function update(updateProfileRequest $request)
    {
        $this->profileservice->updateProfile($request);

        return to_route('admin.profile.list');
    }

    public function deleteProfile($id)
    {
        $this->profileservice->deleteProfile($id);
        return to_route('admin.profile.list')->with('success', 'The admin is deleted successfully');
    }

    public function details($id)
    {
        $profile = $this->profileservice->getProfileDetails($id);
        return view('admin.profile.details',compact('profile'));
    }

    public function states(Request $request)
    {
       $states = $this->profileservice->getStates($request->id);
       return response()->json(['states' => $states]);
    }

    public function city(Request $request)
    {
       $cities = $this->profileservice->getCities($request->id);
       return response()->json(['cities' => $cities]);
    }

    public function deleteGalleryImg(Request $request)
    {
        $this->profileservice->deleteGalleryImage($request->id);
        return response()->json(['message' => 'image deleted successfully','success'=> true]);
    }

    public function changeStatus($id)
    {
        $this->profileservice->changeStatus($id);

        return redirect()->back();
    }

}
