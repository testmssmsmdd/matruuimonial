<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

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
        $data['username'] = $data['first_name'].rand(1,9);

        return $this->userRepository->store($data);
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function updateUser($id, $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
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


