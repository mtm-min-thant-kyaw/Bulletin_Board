<?php

namespace App\Http\Controllers;

use App\Services\LoginService;
use App\Services\RegisterService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * This function return to login page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function loginPage()
    {
        return view('auth.login');
    }
    /**
     * This function return login user data.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginUser()
    {
        $user = Auth::user();
        // dd($user);
        return view('layouts.app', compact('user'));
    }

    /**
     * This function return to user register page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function registerPage()
    {
        return view('auth.register');
    }

    protected $loginService;
    protected $registerService;

    /**
     * Write a constructor for LoginService and RegisterService
     * @param \App\Services\LoginService $loginService
     * @param \App\Services\RegisterService $registerService
     */
    public function __construct(LoginService $loginService, RegisterService $registerService)
    {
        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }
    /**
     * This register function work for register.blade.php to save user input data to db.
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->registerService->registerUser($request->validated());
            Auth::login($user);
            return redirect()->route('loginPage')->with('success', 'Register Success.Login Again.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }


    /**
     *This function work for login.
     * @param \App\Http\Requests\LoginRequest $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {

        try {
            $user = $this->loginService->loginUser($request->validated());
            $request->session()->put('loginId', $user->id);
            Auth::login($user);
            // Redirect based on user role
            if ($user->type == 1) {
                return redirect()->route('user.userlist');
            } else {
                return redirect()->route('post.postlist');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            Auth::logout();
            return redirect()->route('loginPage');
        }
    }
}
