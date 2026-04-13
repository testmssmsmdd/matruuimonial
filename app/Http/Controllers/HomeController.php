<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Models\FavouriteProfile;
use Auth;

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

    public function getProfile($id)
    {
        $profile = $this->homeService->getProfileDetails($id);

        $is_favourite = FavouriteProfile::where('user_id',Auth::user()?->id)->where('profile_id',$id)->first();
        return view('user_profile', compact('profile','is_favourite'));
    }

    
}