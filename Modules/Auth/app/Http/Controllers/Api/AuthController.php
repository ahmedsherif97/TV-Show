<?php

namespace Modules\Auth\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:show auth')->only(['index', 'datatable']);
        // $this->middleware('permission:create auth')->only(['create', 'store']);
        // $this->middleware('permission:update auth')->only(['edit', 'update']);
        // $this->middleware('permission:delete auth')->only(['destroy']);
    }

    public function login()
    {
        request()->validate([
            'email'          => 'required|max:255',
            'password'       => 'required|min:8',
            'firebase_token' => 'nullable|string|max:1000'
        ]);

        $user = User::where('email', request('email'))
            ->orWhere('phone', request('email'))
            ->orWhere('username', request('email'))
            ->first();

        // check password
        if (!$user || !Hash::check(request('password'), $user->password)) {
            return $this->errorResponse(__('validation.user_or_password_error'), [], [], 422);
        }

        return $this->successResponse('logged_in_successfully', [
            'access_token'  => $user->createToken('authToken')->plainTextToken,
            'user'          => User::find($user->id)
        ]);
    }
}
