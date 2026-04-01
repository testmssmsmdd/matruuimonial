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
        // $adminList = User::where([
        //     ['role', 'admin'],
        //     [function ($query) use ($request) {
        //         if (($s = $request->search)) {
        //             $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('last_name', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('email', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('phone_number', 'LIKE', '%' . $s . '%')
        //                 ->get();
        //         }
        //     }]
        // ])->paginate(10);
        $adminList = $this->userservice->getAdminList($request);

        return view('admin.list',compact('adminList'));
    }

    public function add()
    {
        return view('admin/add');
    }

    public function store(StoreUserRequest $req)
    {
        // $validated = $req->validated();

        // $validated['password'] = Hash::make($req->password);

        // User::Insert($validated);
        $this->userservice->createUser($req->validated());
        return to_route('admin.list')->with('success', 'The admin is saved successfully');
    }

    public function edit(Request $request, $id)
    {
        // $user = User::where('id',$id)->first();
        $user = $this->userservice->getUserById($id);
        return view('admin/edit',compact('user'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
        // $user = new User();
        // $validatedData = $request->validated();

        // if ($request->filled('password')) {
        //     $validatedData['password'] = Hash::make($request->input('password'));
        // } else {
        //     unset($validatedData['password']);
        // }
        // $user->where('id',$id)->update($validatedData);

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
        // if($request->status == 0){
        //     $status = User::where('id', $request->id)->update(['is_active' => 0]);
        // }else if($request->status == 1){
        //     $status = User::where('id', $request->id)->update(['is_active' => 1]);
        // }
        $this->userservice->changeStatus($request->id, $request->status);
        return Response::json(['success' => true]);

    }
}
