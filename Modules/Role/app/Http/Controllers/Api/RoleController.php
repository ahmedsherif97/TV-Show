<?php

namespace Modules\Role\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class RoleController extends Controller
{

    public function index()
    {
        return view('role::index');
    }

    public function create()
    {
        return view('role::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('role::show');
    }

    public function edit($id)
    {
        return view('role::edit');
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
