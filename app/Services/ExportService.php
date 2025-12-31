<?php

namespace App\Services;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class ExportService
{
    public function export(string $locale)
    {
        return Cache::remember("translations_{$locale}", 60, function () use ($locale) {
            return Translation::whereHas('locale', fn ($q) =>
                $q->where('code', $locale)
            )->pluck('value', 'key');
        });
    }
}
