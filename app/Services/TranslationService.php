<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    public function create(array $data): Translation
    {
        $translation = Translation::create($data);

        if (!empty($data['tags'])) {
            $tags = Tag::firstOrCreate(['name' => $data['tags']]);
            $translation->tags()->sync($tags->pluck('id'));
        }

        Cache::flush();

        return $translation;
    }

    public function update(Translation $translation, array $data): Translation
    {
        $translation->update($data);

        if (isset($data['tags'])) {
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $translation->tags()->sync($tagIds);
        }

        Cache::flush();

        return $translation;
    }
}
