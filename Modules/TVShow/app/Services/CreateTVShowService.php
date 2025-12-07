<?php

namespace Modules\TVShow\App\Services;

use Modules\TVShow\App\Interfaces\TVShowRepositoryInterface;
use Modules\TVShow\App\Models\TVShow;

class CreateTVShowService
{
    public function __construct(
        private TVShowRepositoryInterface $repository
    ) {}

    public function execute(array $data): TVShow
    {
        $isActive = array_key_exists('is_active', $data)
            ? (bool) $data['is_active']
            : true;

        $show = $this->repository->create([
            'title'       => $data['title'],
            'slug'        => $data['slug'],
            'description' => $data['description'] ?? null,
            'is_active'   => $isActive,
        ]);

        $this->syncSchedules($show, $data['schedules'] ?? []);

        return $show;
    }

    private function syncSchedules(TVShow $show, array $schedules): void
    {
        if (empty($schedules)) {
            return;
        }

        $clean = [];
        foreach ($schedules as $schedule) {
            if (
                isset($schedule['day_of_week'], $schedule['start_time']) &&
                $schedule['start_time'] !== ''
            ) {
                $clean[] = [
                    'day_of_week' => (int) $schedule['day_of_week'],
                    'start_time'  => $schedule['start_time'],
                ];
            }
        }

        if (!empty($clean)) {
            $show->schedules()->createMany($clean);
        }
    }
}
