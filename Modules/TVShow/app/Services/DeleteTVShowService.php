<?php
namespace Modules\TVShow\App\Services;

use Modules\TVShow\App\Interfaces\TVShowRepositoryInterface;
use Modules\TVShow\App\Models\TVShow;

class DeleteTVShowService
{
    public function __construct(
        private TVShowRepositoryInterface $repository
    ) {}

    public function execute(TVShow $show): void
    {
        $this->repository->delete($show);
    }
}
