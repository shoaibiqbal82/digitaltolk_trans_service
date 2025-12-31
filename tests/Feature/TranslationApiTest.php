<?php

namespace Tests\Feature;

use App\Models\Locale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_translation(): void
    {
        $user = User::factory()->create();
        $locale = Locale::factory()->create([
            'code' => 'en',
            'name' => 'English',
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/translations', [
                'key' => 'auth.login',
                'value' => 'Login',
                'locale_id' => $locale->id,
            ]);

        $response->assertStatus(201);
    }

    public function test_export_returns_translations(): void
    {
        Locale::factory()->create([
            'code' => 'en',
            'name' => 'English',
        ]);

        \App\Models\Translation::factory()->count(10)->create();

        $this->getJson('/api/export/en')
            ->assertOk()
            ->assertJsonCount(10);
    }
}
