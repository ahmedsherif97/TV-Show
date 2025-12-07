<?php

namespace Modules\User\App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{

    public function index()
    {
        return view('user::index');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('user::show');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
