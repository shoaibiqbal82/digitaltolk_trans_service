<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ExportService;

class ExportController extends Controller
{
    public function __invoke(string $locale, ExportService $service)
    {
        return response()->json(
            $service->export($locale),
            200,
            ['Cache-Control' => 'public, max-age=60']
        );
    }
}
