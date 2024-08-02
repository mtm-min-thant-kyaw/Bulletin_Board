<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\RegisterService;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function userListPage()
    {
        $user = Auth::user();
        $users = User::with('user')->latest()->paginate(4);
        return view('user.userList', compact('users'));
    }
    public function userCreatePage()
    {
        return view('user.createUser');
    }

    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    /**
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(RegisterRequest $request)
    {
        try {
            $user = $this->registerService->registerUser($request->validated());
            return redirect()->route('user.userlist')->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
