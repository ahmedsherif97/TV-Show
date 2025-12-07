<?php

namespace Modules\Notification\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Notification\App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:show notification')->only(['index', 'datatable']);
        // $this->middleware('permission:create notification')->only(['create', 'store']);
        // $this->middleware('permission:update notification')->only(['edit', 'update']);
        // $this->middleware('permission:delete notification')->only(['destroy']);
    }

    public function index()
    {
        return view('notification::index', ['title' => config('notification.name')]);
    }

    public function create()
    {
        return view('notification::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('notification::show');
    }

    public function edit($id)
    {
        return view('notification::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
