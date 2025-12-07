<?php

namespace Modules\Notification\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Meeting\App\Models\Meeting;
use Modules\Notification\App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show notification')->only(['index', 'datatable']);
        $this->middleware('permission:create notification')->only(['create', 'store']);
        $this->middleware('permission:update notification')->only(['edit', 'update']);
        $this->middleware('permission:delete notification')->only(['destroy']);
    }

    public function index()
    {
        return view('notification::dashboard.index', [
            'title' => __('dashboard.my notifications'),
            'result' => []
        ]);
    }

    public function datatable()
    {
        $html = view('notification::dashboard.datatable', [
            'result' => $result = Notification::query()->where('notifiable_id', auth()->id())
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);
        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('notification::dashboard.create', [
            'title' => config('notification.name')
        ]);
    }

    public function store(Request $request)
    {
        Notification::create(request()->validate([
            'name' => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show($id)
    {
        return view('notification::dashboard.show');
    }

    public function edit($id)
    {
        return view('notification::dashboard.edit');
    }

    public function update(Request $request, $id)
    {
        Notification::create(request()->validate([
            'name' => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }
}
