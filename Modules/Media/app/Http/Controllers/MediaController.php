<?php

namespace Modules\Media\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Media\App\Models\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:list media')->only(['index', 'datatable']);
        // $this->middleware('permission:show media')->only(['show']);
        // $this->middleware('permission:create media')->only(['create', 'store']);
        // $this->middleware('permission:update media')->only(['edit', 'update']);
        // $this->middleware('permission:delete media')->only(['destroy']);
    }

    public function index()
    {
        return view('media::index', ['title' => config('media.name')]);
    }

    public function create()
    {
        return view('media::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('media::show');
    }

    public function edit($id)
    {
        return view('media::edit');
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
