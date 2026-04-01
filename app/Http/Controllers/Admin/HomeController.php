<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Services\UserService;

class HomeController extends Controller
{
    public function __construct(protected UserService $userservice){

    }
    public function list(Request $request)
    {
        $adminList = $this->userservice->getAdminList($request);

        return view('admin.list',compact('adminList'));
    }

    public function add()
    {
        return view('admin/add');
    }

    public function store(StoreUserRequest $req)
    {
        $this->userservice->createUser($req->validated());
        return to_route('admin.list')->with('success', 'The admin is saved successfully');
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userservice->getUserById($id);
        return view('admin/edit',compact('user'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
        $this->userservice->updateUser($id, $request->validated());
        return to_route('admin.list')->with('success', 'The admin is updated successfully');
    }

    public function destroy($id)
    {
        $this->userservice->deleteUser($id);
        return to_route('admin.list')->with('success', 'The admin is deleted successfully');
    }

    public function change_status(Request $request)
    {
        $this->userservice->changeStatus($request->id, $request->status);
        return Response::json(['success' => true]);

    }
}
