<?php

namespace Modules\Auth\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Auth\App\Models\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show auth')->only(['index', 'datatable']);
        $this->middleware('permission:create auth')->only(['create', 'store']);
        $this->middleware('permission:update auth')->only(['edit', 'update']);
        $this->middleware('permission:delete auth')->only(['destroy']);
    }

    public function index()
    {
        return view('auth::dashboard.index', [
            'title'     => config('auth.name'),
            'result'    => []
        ]);
    }

    public function datatable()
    {
        return view('auth::dashboard.datatable', [
            'result'    => Auth::query()
                ->paginate()
        ]);
    }

    public function create()
    {
        return view('auth::dashboard.create', [
            'title'     => config('auth.name')
        ]);
    }

    public function store(Request $request)
    {
        Auth::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show($id)
    {
        return view('auth::dashboard.show');
    }

    public function edit($id)
    {
        return view('auth::dashboard.edit');
    }

    public function update(Request $request, $id)
    {
        Auth::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(Auth $auth)
    {
        $auth->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }
}
