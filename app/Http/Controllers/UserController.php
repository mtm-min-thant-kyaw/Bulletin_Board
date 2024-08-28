<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Models\User;
use App\Jobs\SendBdWish;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User List page with search function.
     *
     * @param mixed $request
     * @return View
     */
    public function userListPage(Request $request): view
    {
        $filters = $request->only(['name', 'email', 'startDate', 'endDate']);

        if (Auth::user()->type == 1) {
            $users = User::where('type', Auth::user()->type)->latest()->search($filters)->paginate(5);
        } else {
            $users = User::latest()->search($filters)->paginate(5);
        }

        return view('user.userList', compact('users'));
    }

    /**
     * direct to user create page
     *
     * @return View
     */
    public function userCreatePage(): View
    {
        return view('user.createUser');
    }

    /**
     * Pass data to user creation confirm page
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return View
     */
    public function userConfirmPage(UserRequest $request): View
    {
        $data = $request->all();
        if (isset($data['profile'])) {
            $fileName = uniqid() . $request->profile->getClientOriginalName();
            $request->profile->storeAs('public', $fileName);
            $data['profile'] = $fileName;
        }
        return view('User.confirmCreateUser', compact('data'));
    }

    /**
     *This function use as common to store new user.

     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {

        $this->userService->registerUser($request);
        return redirect()->route('user.userlist')->with('success', 'User Created Successfully');
    }

    /**
     * Client can't delete by himself.Admin can delete all user.Users can delete that they are created.
     *
     * @param mixed $id
     * @return mixed|RedirectResponse
     */
    public function userDelete($id): RedirectResponse
    {
        $user =$this->userService->deleteUser($id);
        SendBdWish::dispatch($user);

        return redirect()->back()->with('success', 'Deleted a user successfully.');

    }
    public function userEdit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('User.edituser', compact('user'));
    }
}
