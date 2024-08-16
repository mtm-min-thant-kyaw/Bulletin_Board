<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use App\Models\User;


class UserService
{
    /**
     *  Add new user by Login user.This function work confirmCreateUser.blade
     *
     * @param mixed $data
     * @return User
     */
    public function registerUser($data): User
    {
        try {
            DB::beginTransaction();
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
            $user->profile = $data['profile'] ?? 'Profile Photo';
            $user->created_user_id = Auth::id() ?? null;
            $user->updated_user_id = Auth::id() ?? null;
            $user->deleted_user_id = null;
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Summary of signUpUser
     * @param mixed $data
     * @return \App\Models\User
     */
    public function signUpUser($data): User
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->phone = $data['phone'];
            $user->address = $data['address'] ?? null;
            $user->type = 1;
           if(isset($data['profile'])){
            $fileName = uniqid() . $data['profile']->getClientOriginalName();
            $data['profile']->storeAs('Public', $fileName);
            $user->profile = $fileName;
           }
            if (isset($data['dob'])) {
                $user->dob = Carbon::parse(($data['dob']));
            }
            $user->created_user_id = 1;
            $user->updated_user_id = 1;
            $user->deleted_user_id = null;
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * updateUserData for profile and edit user
     * @param UserRequest $request
     * @param string $id
     * @return array
     */
    public function updateUserData(UserRequest $request, string $id): array
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->type = $request->input('type');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            if ($request->input('dob')) {
                $user->dob = $request->input('dob');
            };
            $user->address = $request->input('address');
            // Handle profile image upload.
            if ($request->hasFile('newprofile')) {
                Storage::disk('local')->delete('Storage'.$request->oldProfile);
                $imageName = uniqid() . '.' . $request->newprofile->getClientOriginalName();
                $request->newprofile->storeAs('Public', $imageName);
                $user->profile = $imageName;
            }
            $user->updated_user_id = Auth::id();
            $user->save();
            DB::commit();
            return ['success' => 'Profile updated successfully.'];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function deleteUser($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            if ($user->id != Auth::user()->id)
            {
                $user->delete();
            }
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function getUserById(int $id){
        $user = User::findOrFail($id);
        return $user;
    }
}
