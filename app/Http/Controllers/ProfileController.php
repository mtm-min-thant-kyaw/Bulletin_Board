<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use App\Models\User;
use Exception;

class ProfileController extends Controller
{
    protected $registerService;
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * pass Auth user's data to profile page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function profilePage(): View
    {
        $authUser = Auth::user();
        return view('user.profile', compact('authUser'));
    }

    /**
     * pass Auth user's data to profile page
     *
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function profileEditPage($id): View
    {
        $user = User::find($id);
        return view('user.editProfile', compact('user'));
    }

    /**
     * Profile update function
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(RegisterRequest $request, $id)
    {
        try {
            $result = $this->registerService->updateProfile($request, $id);
            return redirect()->route('user.userlist')->with($result);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e)->withInput();
        }
    }
}
