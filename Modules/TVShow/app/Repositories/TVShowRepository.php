<?php

namespace Modules\TVShow\App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\TVShow\App\Interfaces\TVShowRepositoryInterface;
use Modules\TVShow\App\Models\TVShow;

class TVShowRepository implements TVShowRepositoryInterface
{
    public function paginateWithSchedules(
        ?string $search,
        string $orderBy,
        string $orderAs,
        int $perPage
    ): LengthAwarePaginator {
        return TVShow::query()
            ->with('schedules')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('slug', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy($orderBy, $orderAs)
            ->paginate($perPage);
    }

    public function create(array $data): TVShow
    {
        return TVShow::create($data);
    }

    public function update(TVShow $show, array $data): TVShow
    {
        $show->update($data);
        return $show;
    }

    public function delete(TVShow $show): void
    {
        $show->delete();
    }
}
