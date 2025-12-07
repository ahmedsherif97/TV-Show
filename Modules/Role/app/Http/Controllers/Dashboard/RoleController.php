<?php

namespace Modules\Role\App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list role')->only(['index', 'datatable']);
        $this->middleware('permission:show role')->only(['show']);
        $this->middleware('permission:create role')->only(['create', 'store']);
        $this->middleware('permission:update role')->only(['edit', 'update']);
        $this->middleware('permission:delete role')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('role::dashboard.index', [
            'title' => __('role::dashboard.roles'),
            'result' => Role::withCount('users')->get()
        ]);
    }

    public function datatable()
    {
        $html = view('role::dashboard.datatable', [
            'result' => $result = Role::query()
                ->when(request('search'), function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search') . '%');
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);
        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('role::dashboard.create', [
            'title' => config('role.name')
        ]);
    }

    public function store(Request $request)
    {
        Role::create(request()->validate([
            'name' => 'required|string|min:2|max:255|unique:roles',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show($id)
    {
        return view('role::dashboard.show');
    }

    public function edit($id)
    {
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $nameParts = explode(' ', $permission->name);
            return $nameParts[1] ?? $nameParts[0];
        });

        $role = Role::with('permissions')->findOrFail($id);


        $title = __('dashboard.update') . ' ' . __('role::dashboard.the role');

        return view('role::dashboard.edit', compact('groupedPermissions', 'role', 'title'));
    }


    public function update(Role $role)
    {
        request()->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable'
        ]);

        $role->permissions()->sync(array_keys(request()->permissions ?? []));

        // Clear the Spatie permission cache
        Artisan::call('cache:forget', ['key' => 'spatie.permission.cache']);

        return redirect()->route('dashboard.role.index')->with('alert-success', trans('dashboard.update.success'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }
}
