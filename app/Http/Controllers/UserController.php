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
        $users = User::with('createUser')->latest()->paginate(4);
        return view('user.userList', compact('users'));
    }
    public function userCreatePage()
    {
        $type =  ["user" => 0, "admin" => 1];
        return view('user.createUser', compact('type'));
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
    public function store(RegisterRequest $request)
    {
        dd($this->registerService->registerUser($request));
        try {
            $user = $this->registerService->registerUser($request->validated());
            return redirect()->route('user.userlist')->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
