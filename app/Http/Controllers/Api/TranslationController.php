<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        return Translation::with('tags', 'locale')
            ->when($request->key, fn ($q) =>
                $q->where('key', 'like', "%{$request->key}%")
            )
            ->when($request->content, fn ($q) =>
                $q->where('value', 'like', "%{$request->content}%")
            )
            ->when($request->tag, fn ($q) =>
                $q->whereHas('tags', fn ($t) =>
                    $t->where('name', $request->tag)
                )
            )
            ->paginate(50);
    }

    public function store(Request $request, TranslationService $service)
    {
        $data = $request->validate([
            'key' => 'required',
            'value' => 'required',
            'locale_id' => 'required|exists:locales,id',
            'tags' => 'array'
        ]);

        return response()->json(
            $service->create($data),
            201
        );
    }

    public function show(Translation $translation)
    {
        return $translation->load('tags', 'locale');
    }

    public function update(Request $request, Translation $translation, TranslationService $service)
    {
        return $service->update($translation, $request->all());
    }
}
