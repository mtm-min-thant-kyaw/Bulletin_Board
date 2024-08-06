<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RegisterService;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userListPage()
    {
        $users = User::with('createUser')->where('id', '!=', Auth::user()->id)->latest()->paginate(4);
        return view('user.userList', compact('users'));
    }
    public function userCreatePage()
    {

        return view('user.createUser');
    }
    public function userConfirmPage(RegisterRequest $request)
    {
        $request->validated();
        if ($request->hasFile('profile')) {
            $fileName = uniqid() . $request->profile->getClientOriginalName();
            $request->profile->storeAs('public', $fileName);
        }
        $data = $request->all();
        $profile =['profile' => $fileName];
        return view('User.confirmCreateUser',compact('data','profile'));
    }
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    /**
     *This function use as common to store new user and update user.
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {

        $user = $this->registerService->registerUser($request->validated());
        return redirect()->route('user.userlist')->with('success', 'User Created Successfully');
    }
}
