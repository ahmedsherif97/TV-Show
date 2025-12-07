<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout', 'verify');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function redirectTo()
    {
        if (request()->has('previous')) return request()->get('previous');
        return $this->redirectTo;
    }

    protected function verify()
    {
        User::query()->where('email', request('email'))->first()?->update([
            'email_verified_at' => Carbon::now()
        ]);
        session()->put('success', __('dashboard.email verified successfully'));
        return redirect()->route('admin.login');
    }

    public function username()
    {
        return 'email-username';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (!auth('admin')->user()->userable ||
                (auth('admin')->user()->userable && in_array(auth('admin')->user()->userable->status, ['pending', 'active']))) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                return $this->sendLoginResponse($request);
            }
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('dashboard.home');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/dashboard');
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->input('email-username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $field => $request->input('email-username'),
            'password' => $request->input('password'),
            'type' => 'admin',
        ];
    }
}
