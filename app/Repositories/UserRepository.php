<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAdminList($request)
    {
        return User::where('role', 'admin')
            ->when($request->search, function ($query) use ($request) {
                $s = $request->search;
                $query->where(function ($q) use ($s) {
                    $q->where('first_name', 'LIKE', "%$s%")
                        ->orWhere('last_name', 'LIKE', "%$s%")
                        ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$s}%"])
                        ->orWhere('email', 'LIKE', "%$s%")
                        ->orWhere('phone_number', 'LIKE', "%$s%");
                });
            })
            ->where('profile_status',1)->orderBy('id','Desc')->paginate(12);
    }


    public function store($data)
    {
        return User::create($data);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);

        $user->is_active = $status;
        $user->save();

        return $user;
    }
}