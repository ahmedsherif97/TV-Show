<?php

namespace Modules\Notification\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:show notification')->only(['index', 'datatable']);
        // $this->middleware('permission:create notification')->only(['create', 'store']);
        // $this->middleware('permission:update notification')->only(['edit', 'update']);
        // $this->middleware('permission:delete notification')->only(['destroy']);
    }

    public function index() {}

    public function store()
    {
        $data = Notification::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return $this->successResponse(trans('api.create.success'), [
            'data' => $data
        ]);
    }

    public function show(Notification $notification)
    {
        return $this->successResponse('', [
            'data' => Notification::findOrFail($id)
        ]);
    }

    public function update(Notification $notification)
    {
        $data = tap($notification)->update(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]))->first();

        return $this->successResponse(trans('api.update.success'), [
            'data' => $data
        ]);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete;
        return $this->successResponse(trans('api.delete.success'));
    }
}
