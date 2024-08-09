<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterService
{
    /**
     *  Add new user by Login user.This function work confirmCreateUser.blade
     *
     * @param mixed $data
     * @return User
     */
    public function registerUser($data) :User
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'] ?? null;
        $user->type = $data['type'] ?? 1;
        if (isset($data['dob'])) {
            $user->dob = Carbon::parse(($data['dob']));
        }
        $user->profile = $data['profile'];
        $user->created_user_id = Auth::id() ?? null;
        $user->updated_user_id = Auth::id() ?? null;
        $user->deleted_user_id = null;
        $user->save();
        return $user;
    }

    /**
     * Summary of signUpUser/intital  register for new user.register.blade
     * @param mixed $data
     * @return User
     */
    public function signUpUser($data): User
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'] ?? null;
        $user->type = 1;
        $fileName = uniqid() . $data['profile']->getClientOriginalName();
        $data['profile']->storeAs('Public', $fileName);
        $user->profile = $fileName;
        if (isset($data['dob'])) {
            $user->dob = Carbon::parse(($data['dob']));
        }
        $user->created_user_id = 1;
        $user->updated_user_id = 1;
        $user->deleted_user_id = null;
        $user->save();
        return $user;
    }

    /**
     * Work for update datas of a user.
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return array
     */
    public function updateProfile(Request $request, string $id): array
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->type = $request->input('type');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
       if($request->input('dob')){
        $user->dob = $request->input('dob');
       };
        $user->address = $request->input('address');
        // Handle profile image upload.
        if ($request->hasFile('newprofile')) {
            $imageName = uniqid() . '.' . $request->newprofile->getClientOriginalName();
            $request->newprofile->storeAs('Public',$imageName);
            $user->profile = $imageName;
        }
        $user->updated_user_id = Auth::id();
        $user->save();

        return ['success' => 'Profile updated successfully.'];
    }
}
