<?php

namespace Modules\Episode\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class EpisodeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:list episode')->only(['index', 'datatable']);
        // $this->middleware('permission:show episode')->only(['show']);
        // $this->middleware('permission:create episode')->only(['create', 'store']);
        // $this->middleware('permission:update episode')->only(['edit', 'update']);
        // $this->middleware('permission:delete episode')->only(['destroy']);
    }

    public function index()
    {
        
    }

    public function store()
    {
        $data = Episode::create(request()->validate([
            'name'        => 'required|string|min:2|max:191',
        ]));

        return $this->successResponse(trans('api.create.success'), [
            'data' => $data
        ]);
    }

    public function show(Episode $episode)
    {
        return $this->successResponse('', [
            'data' => Episode::findOrFail($id)
        ]);
    }

    public function update(Episode $episode)
    {
        $data = tap($episode)->update(request()->validate([
            'name'        => 'required|string|min:2|max:191',
        ]))->first();

        return $this->successResponse(trans('api.update.success'), [
            'data' => $data
        ]);
    }

    public function destroy(Episode $episode)
    {
        $episode->delete;
        return $this->successResponse(trans('api.delete.success'));
    }
}
