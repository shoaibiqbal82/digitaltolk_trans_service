<?php

namespace Database\Seeders;

use App\Models\Locale;
use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        Locale::insert([
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'fr', 'name' => 'French'],
            ['code' => 'es', 'name' => 'Spanish'],
        ]);

        Translation::factory()->count(100000)->create();
    }
}
