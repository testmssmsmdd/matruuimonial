<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Str;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAdminList($request)
    {
        return $this->userRepository->getAdminList($request);
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);

        $baseUsername = Str::slug($data['first_name']);
        $username = $baseUsername;
        $i = 1;
        while (\App\Models\User::where('username', $username)->exists()) {
            $username = $baseUsername . $i;
            $i++;
        }
        $data['username'] = $username;

        return $this->userRepository->store($data);
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (!empty($data['first_name']) && $data['first_name'] !== $user->first_name) {
            $baseUsername = Str::slug($data['first_name']);
            $username = $baseUsername;
            $i = 1;

            while (
                User::where('username', $username)
                    ->where('id', '!=', $id)
                    ->exists()
            ) {
                $username = $baseUsername . $i;
                $i++;
            }
            $data['username'] = $username;
        }

        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    public function changeStatus($id, $status)
    {
        $status = $status ? 1 : 0;

        return $this->userRepository->updateStatus($id, $status);
    }
}


