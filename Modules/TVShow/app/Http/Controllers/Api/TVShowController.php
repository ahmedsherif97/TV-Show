<?php

namespace Modules\TVShow\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class TVShowController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:list tvshow')->only(['index', 'datatable']);
        // $this->middleware('permission:show tvshow')->only(['show']);
        // $this->middleware('permission:create tvshow')->only(['create', 'store']);
        // $this->middleware('permission:update tvshow')->only(['edit', 'update']);
        // $this->middleware('permission:delete tvshow')->only(['destroy']);
    }

    public function index()
    {
        
    }

    public function store()
    {
        $data = TVShow::create(request()->validate([
            'name'        => 'required|string|min:2|max:191',
        ]));

        return $this->successResponse(trans('api.create.success'), [
            'data' => $data
        ]);
    }

    public function show(TVShow $tvshow)
    {
        return $this->successResponse('', [
            'data' => TVShow::findOrFail($id)
        ]);
    }

    public function update(TVShow $tvshow)
    {
        $data = tap($tvshow)->update(request()->validate([
            'name'        => 'required|string|min:2|max:191',
        ]))->first();

        return $this->successResponse(trans('api.update.success'), [
            'data' => $data
        ]);
    }

    public function destroy(TVShow $tvshow)
    {
        $tvshow->delete;
        return $this->successResponse(trans('api.delete.success'));
    }
}
