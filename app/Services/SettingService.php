<?php

namespace App\Services;

class SettingService
{
    public function __construct(protected $settings) {}

    public function list()
    {
        return $this->settings;
    }

    public function find(string $slug, $default = '')
    {
        $record = $this->settings->where('slug', $slug)->first();
        if ($record) {
            $value = $record?->value;
            if ($record->type == 'image') {
                $value .= "?v=" . $record->updated_at?->timestamp ?? '';
            }
        }
        return  $value ?? $default;
    }
}
