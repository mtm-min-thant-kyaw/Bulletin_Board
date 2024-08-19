<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\passwordChangeRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Services\passwordService;
use App\Models\PasswordReset;



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
    /**
     * Password Change function
     * @param \App\Http\Requests\passwordChangeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordChange(passwordChangeRequest $request): RedirectResponse
    {
        $this->passwordService->passwordChange($request);
        return redirect()->route('user.userlist')->with('success', 'Password is successfully updated.');
    }

    /**
     * Summary of showLinkRequestForm
     * @return View
     */
    public function showLinkRequestForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Summary of showResetPasswordForm
     * @param mixed $token
     * @return View
     */
    public function showResetPasswordForm($token): View
    {
        $user = $this->passwordService->findUserByToken($token);
        return view('auth.reset-password', compact('token'));
    }

    /**
     * Send email to user with password reset form link
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $token = PasswordReset::createPasswordResetToken($request->email);
        $user = $this->passwordService->findUserByToken($token);
        if(!$user){
            return back()->with('error', 'Email doesn\'t exist.');
        }
        $this->passwordService->sendPasswordResetEmail($request->email, $token);
        return back()->with('success', 'Email has been sent. Check your email.');
    }

    /**
     * ResetPassword Function
     * @param  $request
     * @return RedirectResponse
     */
    public function resetPassword(PasswordResetRequest $request): RedirectResponse
    {
        $user = $this->passwordService->findUserByToken($request->token);

        if (!$user) {
            return redirect()->route('password.reset.form')->with('error', 'Invalid token.');
        }

        $this->passwordService->updateUserPassword($user->email, $request->password);

        return redirect()->route('loginPage')->with('success', 'Password have been reset.');
    }
}
