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
        // $query = Profile::with('mosals');

        // if ($request['gender']) {
        //     $query->where('gender', $request['gender']);
        // }

        // if ($request['city']) {
        //     $query->where('city_id', $request['city']);
        // }

        // if ($request['name']) {
        //     $s = $request['name'];
        //     $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('last_name', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('caste', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('gotra', 'LIKE', '%' . $s . '%')
        //                 ->get();
        // }
        // $profilelist =  $query->where('created_by',Auth::user()->id)->paginate(10);

        // $cityList = DB::table('cities')
        //         ->join('profiles','cities.id','=','profiles.city_id')
        //         ->select('cities.name','cities.id','profiles.city_id','profiles.created_by')
        //         ->where('profiles.created_by',Auth::user()->id)
        //         ->distinct()->get();  
        //         
        // return view('admin.profile.list',compact('profilelist','cityList'));
        //                     

        $data = $this->profileservice->getProfileList($request);

        return view('admin.profile.list', $data);
    }

    public function create()
    {
        // $countries = Country::select('id','name')->get();
        // return view('admin.profile.create', compact('countries'));

         $data = $this->profileservice->getCreateData();
         return view('admin.profile.create', $data);
    }

    public function store(StoreProfileRequest $request)
    {
        // $validated = $request->validated();

        //  DB::transaction(function () use ($validated, $request) {
        //     // Extract mosals
        //     $mosals = $validated['mosal'] ?? [];
        //     unset($validated['mosal']);

        //     // Set height
        //     $validated['height'] = $request->height_ft . '.' . $request->height_in;
        //     $height_ft = $validated['height_ft'] ?? [];
        //     $height_in = $validated['height_in'] ?? [];
        //     unset($validated['height_ft']);
        //     unset($validated['height_in']);

        //     $profile_images = [];

        //     // Create profile
        //     $profile = Profile::create($validated);

        //     // Insert mosals
        //     if (!empty($mosals)) {
        //         $profile->mosals()->createMany($mosals);
        //         $profile->gallery_photos()->createMany($profile_images);
        //         if ($request->hasFile('profile_photo')) {

        //             $imageName = time().'_'.rand(1,1000).'.'.$request->profile_photo->extension();

        //             $request->profile_photo->move(public_path('profile_photos'), $imageName);

        //             $profile->gallery_photos()->create([
        //                 'image' => $imageName,
        //                 'is_profile_photo' => 1,
        //             ]);
        //         }

        //         if($request->hasFile('gallery_photo'))
        //         {
        //             $names = [];
        //             foreach($request->file('gallery_photo') as $image)
        //             {
        //                 $imageName = time().'_'.rand(1,1000).'.'.$image->extension();
        //                 $image->move(public_path('gallery_photo'), $imageName);
        //                 $profile->gallery_photos()->create([
        //                     'image' => $imageName,
        //                     'is_profile_photo' => 0,
        //                 ]);
        //             }
        //         }
        //     }
        // });
        $this->profileservice->createProfile($request);
        return to_route('admin.list')->with('success', 'The profile is saved successfully');
    }


    public function edit($id)
    {
        // $profile = Profile::with(['mosals','profile_photo', 'gallery_photo'])->findorFail($id);
        // $countries = Country::all();
        // return view('admin.profile.edit', compact('profile','countries')); 
        // 
        $data = $this->profileservice->getEditData($id);

        return view('admin.profile.edit', $data);
    }

    public function update(updateProfileRequest $request)
    {
        // $id = $request->profile_id;
        // $validated = $request->validated();

        // DB::transaction(function () use ($validated, $request, $id) {
        //     $profile = Profile::findOrFail($id);
        //     $profile_image = Gallery_photos::where('profile_id',$id)->where('is_profile_photo',1)->first();
        //     $mosals = $validated['mosal'] ?? [];
        //     unset($validated['mosal']);

        //     // Set height
        //     $validated['height'] = $request->height_ft . '.' . $request->height_in;
        //     $height_ft = $validated['height_ft'] ?? [];
        //     $height_in = $validated['height_in'] ?? [];
        //     unset($validated['height_ft']);
        //     unset($validated['height_in']);
        //     $profile->update($validated);
        //     // Insert mosals
        //     if (!empty($mosals)) {
        //         $profile->mosals()->delete();
        //         $profile->mosals()->createMany($mosals);

        //         if ($request->hasFile('profile_photo')) {
        //             if($profile_image){
        //                 if(file_exists(public_path('profile_photos').'/'.$profile_image->image)){
        //                     unlink(public_path('profile_photos').'/'.$profile_image->image);
        //                 }
        //             }
        //             $imageName = time().'_'.rand(1,1000).'.'.$request->profile_photo->extension();
        //             $request->profile_photo->move(public_path('profile_photos'), $imageName);
        //             $profile->profile_photo()->updateOrCreate(['profile_id' => $request->profile_id,'is_profile_photo' => 1],[
        //                 'image' => $imageName,
        //                 'is_profile_photo' => 1
        //             ]);
        //         }

        //         if($request->hasFile('gallery_photo'))
        //         {
        //             $names = [];
        //             foreach($request->file('gallery_photo') as $image)
        //             {
        //                 $imageName = time().'_'.rand(1,1000).'.'.$image->extension();
        //                 $image->move(public_path('gallery_photo'), $imageName);
        //                 $profile->gallery_photo()->create([
        //                     'image' => $imageName,
        //                     'is_profile_photo' => 0,
        //                 ]);
        //             }
        //         }
        //     }
        // });
        // 
        $this->profileservice->updateProfile($request);

        return to_route('admin.profile.list');
    }

    public function deleteProfile($id)
    {
        // $profile = Profile::findOrFail($id);
        // $profile_image = Gallery_photos::where('profile_id',$id)->where('is_profile_photo',1)->first();
        // if(file_exists(public_path('profile_photos').'/'.$profile_image->image)){
        //     unlink(public_path('profile_photos').'/'.$profile_image->image);
        // }
        // $gallery_image = Gallery_photos::where('profile_id',$id)->where('is_profile_photo',0)->get();
        // foreach($gallery_image as $gallery_photo){
        //    if(file_exists(public_path('gallery_photo').'/'.$gallery_photo->image)){
        //         unlink(public_path('gallery_photo').'/'.$gallery_photo->image);
        //     } 
        // }
        // $profile->delete();
        // $profile->mosals()->delete();
        // $profile->profile_photo()->delete();
        // $profile->gallery_photo()->delete();
        $this->profileservice->deleteProfile($id);
        return to_route('admin.profile.list')->with('success', 'The admin is deleted successfully');
    }

    public function details($id)
    {
        // $profile = Profile::with(['mosals','profile_photo','gallery_photo','city'])->where('id',$id)->first();
        $profile = $this->profileservice->getProfileDetails($id);
        return view('admin.profile.details',compact('profile'));
    }

    public function states(Request $request)
    {
       // $id = $request->id;
       // $states = State::where('country_id',$id)->get();
       $states = $this->profileservice->getStates($request->id);
       return response()->json(['states' => $states]);
    }

    public function city(Request $request)
    {
       // $id = $request->id;
       // $city = City::where('state_id',$id)->get();
       $cities = $this->profileservice->getCities($request->id);
       return response()->json(['cities' => $cities]);
    }

    public function mosals(Request $request)
    {
       // $id = $request->id;
       // $mosals = Mosal::where('profile_id',$id)->get();
       $mosals = $this->profileservice->getMosals($request->id);
       return response()->json(['mosals' => $mosals]);
    }


    public function deleteGalleryImg(Request $request)
    {
        // $id = $request->id;
        // $gallery_image = Gallery_photos::where('id',$id)->first();
        // if(file_exists(public_path('gallery_photo').'/'.$gallery_image->image)){
        //     unlink(public_path('gallery_photo').'/'.$gallery_image->image);
        // }
        // $gallery_image->delete();
        $this->profileservice->deleteGalleryImage($request->id);
        return response()->json(['message' => 'image deleted successfully','success'=> true]);
    }

}
