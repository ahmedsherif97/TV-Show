<?php

namespace Modules\User\App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Middleware\DataTableMiddleware;
use App\Models\User;
use Exception;
use App\Services\MailService;
use Modules\User\app\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(
    )
    {
        $this->middleware('permission:list user')->only(['index', 'datatable']);
        $this->middleware(DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('user::dashboard.index', [
            'title' => __('user::dashboard.users_management'),
            'result' => [],
        ]);
    }

    public function datatable()
    {
        $result = User::query()
            ->with('userable')->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'super-admin');
            });

        $html = view('user::dashboard.datatable', [
            'result' => $result = $result
                ->when(request('name'), function ($q) {
                    $q->where('name', 'LIKE', '%' . request('name') . '%');
                })
                ->when(request('email'), function ($q) {
                    $q->where('email', 'LIKE', '%' . request('email') . '%');
                })
                ->when(request('username'), function ($q) {
                    $q->where('username', 'LIKE', '%' . request('username') . '%');
                })
                ->orderBy(request('orderBy', 'id'), request('orderAs', 'desc'))
                ->paginate(request('perPage', 10))
        ]);

        return viewToDatatable($html, $result);
    }


    protected function roles($id)
    {
        $user = User::query()->find($id);
        if ($user->type == 'admin') {
            return view('user::dashboard.roles', [
                'title' => __('role::dashboard.roles'),
                'user' => $user,
                'roles' => Role::query()->get()
            ]);
        } else {
            return redirect()->route('dashboard.user.index');
        }
    }

    protected function updateRoles($id)
    {
        $user = User::query()->find($id);
        $user?->roles()->sync(request('roles'));
        return redirect()->route('dashboard.user.index')->with('alert-success', trans('dashboard.update.success'));
    }
}
