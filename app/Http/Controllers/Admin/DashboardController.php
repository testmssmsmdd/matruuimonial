<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class DashboardController extends Controller
{
    public function __construct(protected UserService $userservice){}

    public function index()
    {
        $role = Auth::user()->role;
        if($role == "Super_Admin")
        {
            $total_profile = Profile::count();
            $male_users = Profile::where('gender','Male')->count();
            $female_users = Profile::where('gender','Female')->count();
            $active_users = Profile::where('profile_status',1)->count();
            $inactive_users = Profile::where('profile_status',0)->count();
        }
        if($role == "Admin")
        {
           $total_profile = Profile::where('created_by',Auth::user()->id)->count();
            $male_users = Profile::where('gender','Male')->where('created_by',Auth::user()->id)->count();
            $female_users = Profile::where('gender','Female')->where('created_by',Auth::user()->id)->count();
            $active_users = Profile::where('profile_status',1)->where('created_by',Auth::user()->id)->count();
            $inactive_users = Profile::where('profile_status',0)->where('created_by',Auth::user()->id)->count(); 
        }
        return view('admin_dashboard',compact('total_profile','male_users','female_users','active_users','inactive_users'));
    }

    public function my_account()
    {
        $user = Auth::user();
        return view('auth.my_account',compact('user'));
    }


    public function update_admin_account(UpdateUserRequest $request,$id)
    {
        $this->userservice->updateUser($id, $request->validated());
        return redirect()->back()->with('success','Account updated successfully.');

    }
 
}
