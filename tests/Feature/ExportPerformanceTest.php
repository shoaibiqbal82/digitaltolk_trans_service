<?php

namespace Tests\Feature;

use App\Models\Locale;
use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportPerformanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_100k_translations_under_500ms(): void
    {
        Locale::factory()->create([
            'code' => 'en',
            'name' => 'English',
        ]);

        Translation::factory()->count(100_000)->create();

        $start = microtime(true);

        $this->getJson('/api/export/en')->assertOk();

        $duration = microtime(true) - $start;

        $this->assertLessThan(
            0.5,
            $duration,
            "Export took {$duration} seconds"
        );
    }
}
