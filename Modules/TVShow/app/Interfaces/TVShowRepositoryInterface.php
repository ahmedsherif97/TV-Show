<?php

namespace Modules\TVShow\App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\TVShow\App\Models\TVShow;

interface TVShowRepositoryInterface
{
    public function paginateWithSchedules(
        ?string $search,
        string $orderBy,
        string $orderAs,
        int $perPage
    ): LengthAwarePaginator;

    public function create(array $data): TVShow;

    public function update(TVShow $show, array $data): TVShow;

    public function delete(TVShow $show): void;
}
