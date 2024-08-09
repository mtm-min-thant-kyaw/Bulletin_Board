<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View as ViewView;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Services\RegisterService;

class AuthController extends Controller
{
    protected $loginService;
    protected $registerService;
    /**
     * Constructor for LoginService and RegisterService
     *
     * @param \App\Services\LoginService $loginService
     * @param \App\Services\RegisterService $registerService
     */
    public function __construct(LoginService $loginService, RegisterService $registerService)
    {
        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }

    /**
     * Return to user login page.
     *
     * @return ViewView|\Illuminate\Contracts\View\Factory
     */
    public function loginPage()
    {
        return view('auth.login');
    }

    /**
     * Return data of Auth user
     *
     * @return ViewView|\Illuminate\Contracts\View\Factory
     */
    public function loginUser()
    {
        $user = Auth::user();
        // dd($user);
        return view('layouts.app', compact('user'));
    }

    /**
     * Return to user register page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registerPage()
    {
        return view('auth.register');
    }

    /**
     * This register function work register.blade.php
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(SignUpRequest $request): RedirectResponse
    {
        $user = $this->registerService->signUpUser($request);
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
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {

        try {
            $user = $this->loginService->loginUser($request->validated());
            $request->session()->put('loginId', $user->id);
            return redirect()->route('user.userlist');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
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
