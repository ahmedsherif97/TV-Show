<?php

namespace Modules\Permission\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list permission')->only(['index', 'datatable']);
        $this->middleware('permission:show permission')->only(['show']);
        $this->middleware('permission:create permission')->only(['create', 'store']);
        $this->middleware('permission:update permission')->only(['edit', 'update']);
        $this->middleware('permission:delete permission')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('permission::dashboard.index', [
            'title'     => config('permission.name'),
            'result'    => []
        ]);
    }

    public function datatable()
    {
        $html = view('permission::dashboard.datatable', [
            'result'    => $result = Permission::query()
                ->when(request('search'), function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search') . '%');
                    // $q->orWhere('email', 'LIKE', '%' . request('search') . '%');
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);
        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('permission::dashboard.create', [
            'title'     => config('permission.name')
        ]);
    }

    public function store(Request $request)
    {
        Permission::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show($id)
    {
        return view('permission::dashboard.show');
    }

    public function edit($id)
    {
        return view('permission::dashboard.edit');
    }

    public function update(Request $request, $id)
    {
        Permission::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }
}
