<?php

namespace Modules\User\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Modules\Category\App\Models\Category;
use Modules\User\App\Models\User;
use Modules\User\app\Services\CompleteRegisterService;

class ProfileController extends Controller
{
    protected $completeRegisterService;

    public function __construct(CompleteRegisterService $completeRegisterService)
    {
        $this->completeRegisterService = $completeRegisterService;
    }
    public function show()
    {
        $user = auth()->user();
        return view('user::dashboard.profile', [
            'title' => __('dashboard.profile'),
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        return view('user::dashboard.edit');
    }

    public function update(Request $request)
    {
        $validated = \request()->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|numeric|min:6',
        ]);
        auth()->user()->update($validated);
        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function updatePassword(Request $request)
    {
        $validated = \request()->validate([
            'password' => 'required|confirmed'
        ]);
        $validated['password'] = Hash::make($request->password);
        auth()->user()->update($validated);
        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function profile()
    {

        $user = auth()->user();
        $accountInfo = $user;
//        $categories = Category::all();


        return view('user::dashboard.profile', [
            'title' => __('dashboard.my info'),
            'user' => $user,
            'accountInfo' => $accountInfo,
//            'categories' => $categories,
        ]);
    }

    public function accountUpdate(Request $request)
    {
        try {
            $message = $this->completeRegisterService->accountUpdate($request);
            return response()->json(['message' => $message]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function uploadAvatar()
    {
        $filePath = $this->uploadFile('file', 'users/avatars');

        auth()->user()->update(['avatar' => $filePath]);

        return $this->successResponse(trans('dashboard.update.success'), [
            'filePath' => $filePath
        ]);
    }
}
