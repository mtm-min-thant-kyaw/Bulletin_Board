<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class ProfileController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * pass Auth user's data to profile page
     *
     * @return View
     */
    public function profilePage(): View
    {
        $authUser = Auth::user();
        return view('user.profile', compact('authUser'));
    }

    /**
     * pass Auth user's data to profile page
     *
     * @param $id
     * @return View
     */
    public function profileEditPage($id): View
    {
        $user = $this->userService->getUserById($id);
        return view('user.editProfile', compact('user'));
    }

    /**
     * Update function for all user and profile
     *
     * @param UserRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateUser(UserRequest $request, $id): RedirectResponse
    {

        $result = $this->userService->updateUserData($request, $id);
        return redirect()->route('user.userlist')->with($result);

    }
}
