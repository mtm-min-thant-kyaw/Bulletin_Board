<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use App\Models\User;

class UserController extends Controller
{
    protected $registerService;
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * User List page with search function.
     *
     *@param mixed $request
     * @return View
     */
    public function userListPage(Request $request): view
    {
        $filters = $request->only(['name', 'email', 'startDate', 'endDate']);
        $users = User::latest()->search($filters)->paginate(5);
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
     * @param \App\Http\Requests\RegisterRequest $request
     * @return View|\Illuminate\Contracts\View\Factory
     */
    public function userConfirmPage(RegisterRequest $request): View
    {
        $data = $request->all();
        $fileName = uniqid() . $request->profile->getClientOriginalName();
        $request->profile->storeAs('public', $fileName);
        $data['profile'] = $fileName;
        return view('User.confirmCreateUser', compact('data'));
    }

    /**
     *This function use as common to store new user and update user.

     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            $user = $this->registerService->registerUser($request);
            return redirect()->route('user.userlist')->with('success', 'User Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('user.userCreatePage')->withErrors($e)->with('success','Your have an account with this email.');
        }
    }

    /**
     * Client can't delete by himself.Admin can delete all user.Users can delete that they are created.
     *
     * @param mixed $id
     * @return mixed|RedirectResponse
     */
    public function userDelete($id): RedirectResponse
    {
        $selectUser = User::find($id);
        if ($selectUser->id != Auth::user()->id && $selectUser->type != 0) {

            $selectUser->delete();
            return redirect()->back()->with('success','Deleted a user successfully.');
        }
        return back()->with('success', 'U can\'t delete this account.');
    }
}
