<?php

namespace Modules\Media\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

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

    public function index() {}

    public function store()
    {
        $data = Media::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return $this->successResponse(trans('api.create.success'), [
            'data' => $data
        ]);
    }

    public function show(Media $media)
    {
        return $this->successResponse('', [
            'data' => Media::findOrFail($id)
        ]);
    }

    public function update(Media $media)
    {
        $data = tap($media)->update(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]))->first();

        return $this->successResponse(trans('api.update.success'), [
            'data' => $data
        ]);
    }

    public function destroy(Media $media)
    {
        $media->delete;
        return $this->successResponse(trans('api.delete.success'));
    }
}
