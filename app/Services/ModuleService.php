<?php

namespace App\Services;


class ModuleService
{

    public function __construct(protected array $modules)
    {
    }

    public function list()
    {
        return $this->modules;
    }
}
