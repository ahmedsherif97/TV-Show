<?php

namespace Modules\TVShow\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\TVShow\App\Models\TVShow;
use Modules\TVShow\App\Services\CreateTVShowService;
use Modules\TVShow\App\Services\DeleteTVShowService;
use Modules\TVShow\App\Services\GetTVShowDatatableService;
use Modules\TVShow\App\Services\UpdateTVShowService;

class TVShowController extends Controller
{
    public function __construct(
        private GetTVShowDatatableService $getDatatableService,
        private CreateTVShowService $createService,
        private UpdateTVShowService $updateService,
        private DeleteTVShowService $deleteService,
    ) {
        $this->middleware('permission:list t_v_show')->only(['index', 'datatable']);
        $this->middleware('permission:show t_v_show')->only(['show']);
        $this->middleware('permission:create t_v_show')->only(['create', 'store']);
        $this->middleware('permission:update t_v_show')->only(['edit', 'update']);
        $this->middleware('permission:delete t_v_show')->only(['destroy']);
        $this->middleware(\App\Http\Middleware\DataTableMiddleware::class)->only('datatable');
    }

    public function index()
    {
        return view('tvshow::dashboard.index', [
            'title' => __('tvshow::dashboard.t_v_shows'),
            'result' => [],
        ]);
    }

    public function datatable(Request $request)
    {
        $result = $this->getDatatableService->execute($request);

        $html = view('tvshow::dashboard.datatable', [
            'result' => $result,
        ]);

        return viewToDatatable($html, $result);
    }

    public function create()
    {
        return view('tvshow::dashboard.create', [
            'title' => __('tvshow::dashboard.create'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateForm($request);

        $this->createService->execute($data);

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function show(TVShow $show)
    {
        $show->load('schedules');

        return view('tvshow::dashboard.show', [
            'title'  => __('tvshow::dashboard.show'),
            'tvshow' => $show,
        ]);
    }

    public function edit(TVShow $show)
    {
        $show->load('schedules');

        return view('tvshow::dashboard.edit', [
            'title'  => __('dashboard.update'),
            'tvshow' => $show,
        ]);
    }

    public function update(Request $request, TVShow $show)
    {
        $data = $this->validateForm($request, $show->id);

        $this->updateService->execute($show, $data);

        return back()->with('alert-success', trans('dashboard.create.success'));
    }

    public function destroy(TVShow $show)
    {
        $this->deleteService->execute($show);

        return back()->with('alert-success', trans('dashboard.delete.success'));
    }

    private function validateForm(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title' => 'required|string|min:2|max:255',
            'slug'  => 'required|string|max:255|unique:tv_shows,slug,' . $id,
            'description' => 'nullable|string',
            'is_active'    => 'nullable|boolean',
            'schedules'    => 'nullable|array',
            'schedules.*.day_of_week' => 'required_with:schedules|integer|between:0,6',
            'schedules.*.start_time'  => 'required_with:schedules|date_format:H:i',
        ]);
    }
}
