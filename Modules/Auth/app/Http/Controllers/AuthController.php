<?php

namespace Modules\Auth\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Auth\App\Models\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:show auth')->only(['index', 'datatable']);
        // $this->middleware('permission:create auth')->only(['create', 'store']);
        // $this->middleware('permission:update auth')->only(['edit', 'update']);
        // $this->middleware('permission:delete auth')->only(['destroy']);
    }

    public function index()
    {
        return view('auth::index', ['title' => config('auth.name')]);
    }

    public function create()
    {
        return view('auth::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('auth::show');
    }

    public function edit($id)
    {
        return view('auth::edit');
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
