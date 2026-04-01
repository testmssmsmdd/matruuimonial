<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\City;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function index(Request $request)
    {
        $query = Profile::with('mosals');

        if ($request['gender']) {
            $query->where('gender', $request['gender']);
        }

        if ($request['city']) {
            $query->where('city_id', $request['city']);
        }

        if ($request['min_age']) {
            $query->where('age','>=', $request['min_age']);
        }

        if ($request['max_age']) {
            $query->where('age','<=', $request['max_age']);
        }

        if ($request['marital_status']) {
            $query->where('marital_status', $request['marital_status']);
        }

        if ($request['name']) {
            $s = $request['name'];
            $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $s . '%')
                        ->orWhere('education', 'LIKE', '%' . $s . '%')
                        ->orWhere('caste', 'LIKE', '%' . $s . '%')
                        ->orWhere('occupation', 'LIKE', '%' . $s . '%');
        }

        $profilelist =  $query->orderBy('id','desc')->paginate(10);
        $cityList = DB::table('cities')
                ->join('profiles','cities.id','=','profiles.city_id')
                ->select('cities.name','cities.id','profiles.city_id')
                ->groupBy('profiles.city_id')->get();


        return view('welcome',compact('cityList','profilelist'));
    }

    public function profile($id)
    {
        $profile = Profile::with(['mosals','profile_photo','gallery_photo','city'])->where('id',$id)->first();
        return view('user.profile',compact('profile'));
    }

    public function userlist($username)
    {
        $user = User::where('username',$username)->first();
        $profilelist = Profile::where('created_by',$user->id)->paginate(10);
        $cityList = DB::table('cities')
                ->join('profiles','cities.id','=','profiles.city_id')
                ->select('cities.name','cities.id','profiles.city_id')
                ->groupBy('profiles.city_id')->get();
        return view('user.profile_list',compact('profilelist','cityList'));
    }
}
