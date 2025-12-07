<?php

namespace Modules\TVShow\App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\TVShow\App\Interfaces\TVShowRepositoryInterface;

class GetTVShowDatatableService
{
    public function __construct(
        private TVShowRepositoryInterface $repository
    ) {}

    public function execute(Request $request): LengthAwarePaginator
    {
        return $this->repository->paginateWithSchedules(
            $request->input('search'),
            $request->input('orderBy', 'id'),
            $request->input('orderAs', 'desc'),
            (int) $request->input('perPage', 10)
        );
    }
}
