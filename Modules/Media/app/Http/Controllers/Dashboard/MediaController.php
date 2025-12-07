<?php

namespace Modules\Media\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Media\App\Models\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list media')->only(['index', 'datatable']);
        $this->middleware('permission:show media')->only(['show']);
        // $this->middleware('permission:create media')->only(['create', 'store']);
        $this->middleware('permission:update media')->only(['edit', 'update']);
        $this->middleware('permission:delete media')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('media::dashboard.index', [
            'title'     => config('media.name'),
            'result'    => []
        ]);
    }

    public function datatable()
    {
        $html = view('media::dashboard.datatable', [
            'result'    => $result = Media::query()
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
        return view('media::dashboard.create', [
            'title'     => config('media.name')
        ]);
    }

    public function store(Request $request)
    {
        // Get the first uploaded file input name (e.g. 'field_98')
        $fieldName = collect($request->allFiles())->keys()->first();

        if (!$fieldName) {
            return response()->json(['success' => false, 'message' => 'No file found'], 400);
        }

        return response()->json([
            'success' => true,
            'path' => $this->uploadFile(
                $fieldName,
                date('Y-m-d'),
                'required|file|mimes:jpeg,jpg,png,webp,pdf,xlsx|max:3000',
                'private'
            )
        ]);
    }


    public function show($id)
    {
        return view('media::dashboard.show');
    }

    public function edit($id)
    {
        return view('media::dashboard.edit');
    }

    public function update(Request $request, $id)
    {
        Media::create(request()->validate([
            'name'        => 'required|string|min:2|max:255',
        ]));

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return back()->with('alert-success', trans('dashboard.delete.success'));
    }

    public function upload()
    {
        return response()->json([
            'success' => true,
            'path' => $this->uploadFile('file', date('Y-m-d'), 'required|file|mimes:jpeg,jpg,png,webp,pdf|max:3000')
        ]);
    }
}
