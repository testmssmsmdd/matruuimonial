<?php
namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;
use App\Models\FavouriteProfile;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeRepository implements HomeRepositoryInterface
{
    public function getProfiles($request)
    {
        $userId = Auth::id();
        $query = Profile::with('mosals')
        ->withCount([
            'favourites as is_favourite' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        ]);

        // Filters
        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->city)) {
            $query->where('city_id', $request->city);
        }

        if (!empty($request->min_age)) {
            $query->where('age', '>=', $request->min_age);
        }

        if (!empty($request->max_age)) {
            $query->where('age', '<=', $request->max_age);
        }

        if (!empty($request->marital_status)) {
            $query->where('marital_status', $request->marital_status);
        }

        if (!empty($request->education)) {
            $query->where('education', $request->education);
        }

        if (!empty($request->profession)) {
            $query->where('occupation', $request->profession);
        }

        if (!empty($request->name)) {
            $s = $request->name;

            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                  ->orWhere('last_name', 'LIKE', "%$s%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                  ->orWhere('education', 'LIKE', "%$s%")
                  ->orWhere('caste', 'LIKE', "%$s%")
                  ->orWhere('occupation', 'LIKE', "%$s%");
            });
        }

        if (!empty($request->sort_by)) {

            if ($request->sort_by == "age") {
                $query->orderBy('age', 'asc');
            }

            elseif ($request->sort_by == "location") {
                $query->orderBy('current_address', 'asc');
            }

            elseif ($request->sort_by == "latest") {
                $query->latest();
            }

        } else {
            $query->latest();
        }

        return $query->where('profile_status',1)->where(function ($query) use ($userId) {
        $query->where('user_id', '!=', $userId)
              ->orWhereNull('user_id');
        })->orderBy('id', 'desc')->paginate(12)->appends($request->all());
    }

    public function getCityList()
    {
        return DB::table('cities')
            ->join('profiles', 'cities.id', '=', 'profiles.city_id')
            ->select('cities.name', 'cities.id')
            ->where('profiles.profile_status',1)
            ->groupBy('profiles.city_id', 'cities.name', 'cities.id')
            ->get();
    }

    public function getCityListByUsername($username)
    {
        return DB::table('cities')
            ->join('profiles', 'cities.id', '=', 'profiles.city_id')
            ->join('users','profiles.created_by', '=', 'users.id')
            ->select('cities.name', 'cities.id')
            ->where('users.username','=',$username)
            ->groupBy('profiles.city_id', 'cities.name', 'cities.id')
            ->get();
    }

    public function findProfileById($id)
    {
        return Profile::with([
            'mosals',
            'profile_photo',
            'gallery_photo',
            'city',
            'admin_details'
        ])->findOrFail($id);
    }

    public function findUserByUsername($username)
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function getProfilesByUser($userId)
    {
        return Profile::where('created_by', $userId)
            ->latest()
            ->paginate(12);
    }

    public function getProfilesByUserWithFilters($request, $userId)
    {
        $query = Profile::with('mosals')
            ->where('created_by', $userId);

        // Filters
        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->city)) {
            $query->where('city_id', $request->city);
        }

        if (!empty($request->min_age)) {
            $query->where('age', '>=', $request->min_age);
        }

        if (!empty($request->max_age)) {
            $query->where('age', '<=', $request->max_age);
        }

        if (!empty($request->marital_status)) {
            $query->where('marital_status', $request->marital_status);
        }

        if (!empty($request->name)) {
            $s = $request->name;

            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%$s%")
                  ->orWhere('last_name', 'LIKE', "%$s%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                  ->orWhere('education', 'LIKE', "%$s%")
                  ->orWhere('caste', 'LIKE', "%$s%")
                  ->orWhere('occupation', 'LIKE', "%$s%");
            });
        }

        return $query->where('profile_status',1)->orderBy('id', 'desc')->paginate(12);
    }


    public function getFavouriteProfiles()
    {
        return FavouriteProfile::where('user_id',Auth::user()->id)->select('profile_id')->get();

    }
}