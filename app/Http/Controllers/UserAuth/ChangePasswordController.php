<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected function changePassword()
    {
        return view('auth.passwords.change');
    }

    protected function doChangePassword(Request $request)
    {
        $rules = [
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ]
        ];
        request()->validate($rules);
        auth()->user()->update([
            'password' => Hash::make(request('password'))
        ]);
        return redirect()->route('dashboard.home')->with('alert-success', trans('dashboard.update.success'));
    }
}