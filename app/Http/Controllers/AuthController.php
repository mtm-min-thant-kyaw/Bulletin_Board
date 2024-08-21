<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $loginService;
    protected $userService;
    protected $passwordChangeService;
    /**
     * Constructor for LoginService and UserService
     *
     * @param \App\Services\LoginService $loginService
     * @param \App\Services\UserService $userService
     */
    public function __construct(LoginService $loginService, UserService $userService)
    {
        $this->loginService = $loginService;
        $this->userService = $userService;
    }

    /**
     * user login page
     * @return View
     */
    public function loginPage(): View
    {
        return view('auth.login');
    }

    /**
     * Return data of Auth user
     *
     * @return View
     */
    public function loginUser(): View
    {
        $user = Auth::user();
        return view('layouts.app', compact('user'));
    }

    /**
     * Return to user register page
     *
     * @return View
     */
    public function registerPage(): View
    {
        return view('auth.register');
    }

    /**
     * This register function work register.blade.php
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(SignUpRequest $request): RedirectResponse
    {
        $user = $this->userService->signUpUser($request);
        if ($user) {
            Auth::login($user);
            $request->session()->put('loginId', $user->id);
            return redirect()->route('user.userlist')->with('success', 'Account created successfully.');
        } else {
            return back();
        }
    }

    /**
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $user = $this->loginService->loginUser($request->validated());
        $request->session()->put('loginId', $user->id);

        return redirect()->route('user.userlist');
    }

    public function logout()
    {

        if (Session::has('loginId')) {
            Auth::logout();
            Session::pull('loginId');

            return redirect()->route('loginPage');
        }
    }
}
