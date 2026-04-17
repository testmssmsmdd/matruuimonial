<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Models\Profile;
use App\Models\FavouriteProfile;
use Auth;
use Str;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService){}

    public function home()
    {
        return view('home');
    }

    public function index(Request $request)
    {
        $data = $this->homeService->getHomeData($request);
        $data['randomProfiles'] = Profile::where('profile_status', 1)
            ->inRandomOrder()->take(4)->get();
        return view('welcome', $data);
    }

    public function profile($id)
    {
        $profile = $this->homeService->getProfileDetails($id);
        return view('user.profile', compact('profile'));
    }

    public function userlist(Request $request, $username)
    {
        $data = $this->homeService->getUserProfiles($request, $username);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('profile_data', [
                    'profilelist' => $data['profilelist']
                ])->render(),
                'next_page' => $data['profilelist']->currentPage() + 1,
                'has_more' => $data['profilelist']->hasMorePages()
            ]);
        }
        return view('user.profile_list', $data);
    }

    public function profiles(Request $request){
        $data = $this->homeService->getHomeData($request);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('profile_data', [
                    'profilelist' => $data['profilelist']
                ])->render(),
                'next_page' => $data['profilelist']->currentPage() + 1,
                'has_more' => $data['profilelist']->hasMorePages()
            ]);
        }

        return view('profiles', $data);
    }

    public function getProfile($slug)
    {
        $profile = $this->homeService->getProfileDetails($slug);

        $is_favourite = FavouriteProfile::where('user_id',Auth::user()?->id)->where('profile_id',$profile->id)->first();
        return view('user_profile', compact('profile','is_favourite'));
    }

    
}