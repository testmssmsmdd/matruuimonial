<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'   => ['required', 'string', 'min:3'],
            'last_name'    => ['required', 'string', 'min:3'],
            'middle_name'  => ['nullable', 'string'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'     => ['nullable', 'string'],
            'phone_number' => ['required', 'digits:10', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'middle_name'  => $data['middle_name'] ?? null,
            'username'     => $data['username'] ?? null,
            'role'         => 'User',
            'is_active'     => 0,
            'email'        => $data['email'],
            'phone_number' => $data['phone_number'],
            'password'     => Hash::make($data['password']),
        ]);

        $profile_exists = Profile::where(function ($query) use ($user) {
            $query->where('contact_person_number', $user['phone_number'])
                  ->orWhere('contact_person_email', $user['email']);
        })->first();
        if($profile_exists){
            Profile::where('id', $profile_exists->id)->update([
                    'user_id' => $user->id
                ]);
        }

        return $user;
    }
}
