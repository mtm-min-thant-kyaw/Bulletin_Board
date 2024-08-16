<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\passwordChangeRequest;
use App\Services\passwordService;

class PasswordController extends Controller
{
    protected $passwordService;
    /**
     * Summary of __construct
     * @param passwordService $passwordService
     */
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    /**
     * Summary of passwordChangePage
     * @param mixed $id
     * @return View
     */
    public function passwordChangePage(): View
    {
        return view('auth.changePassword');
    }
    public function passwordChange(passwordChangeRequest $request)
    {
        $this->passwordService->passwordChange($request);
        return redirect()->route('user.userlist')->with('success', 'Password is successfully updated.');
    }
}
