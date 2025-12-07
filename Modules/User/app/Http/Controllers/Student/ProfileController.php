<?php

namespace Modules\User\App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = auth()->user();
        return view('user::student.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:99",
            "last_name" => "required|string|max:99",
            "email" => "required|email|unique:users,email," . auth()->id(),
            "phone" => "required|numeric|unique:users,phone," . auth()->id(),
            'birthdate' => 'required|date|before:today',
        ]);
        auth()->user()->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
        ]);
        return back()->with('alert-success', 'تم تحديث الملف الشخصي بنجاح.');
    }
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (!Hash::check($validated['currentPassword'], auth()->user()->password)) {
            return back()->with('alert-error', 'كلمة المرور الحالية غير صحيحة');
        }

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('alert-success', 'تم تحديث كلمة المرور بنجاح.');
    }


}
