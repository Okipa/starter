<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;
use Plank\Metable\Metable;

trait HasMeta
{
    use Metable {
        getMeta as traitGetMeta;
    }

    public function saveMetaFromRequest(Request $request, array $metaKeys): void
    {
        foreach ($metaKeys as $metaKey) {
            $this->removeMeta($metaKey);
            $meta = data_get($request->validated(), $metaKey);
            if ($meta) {
                $this->setMeta($metaKey, $meta);
            }
        }
    }

    // Todo: remove `$locale` argument if your app is not multilingual.
    public function getMeta(string $key, $default = null, string $locale = null): array|string|null
    {
        // Todo: replace the lines below by `return $this->traitGetMeta($key, $default)` if your app is not multilingual.
        $meta = $this->traitGetMeta($key, $default);

        return translatedData($meta, null, $locale ?? app()->getLocale());
    }
}
