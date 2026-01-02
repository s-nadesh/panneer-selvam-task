<?php

namespace App\Services;
use App\Models\Tag;

class TagService
{
    /**
     * Create a new class instance.
     */
    public function sync($model, ?string $tagsJson): void
    {
        if (!$tagsJson) {
            $model->tags()->detach();
            return;
        }

        $tags = json_decode($tagsJson, true);

        $tagIds = collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate([
                'name' => $tag['value']
            ])->id;
        });

        $model->tags()->sync($tagIds);
    }
}
