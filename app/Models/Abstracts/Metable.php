<?php

namespace App\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Metable extends Model
{
    use \Plank\Metable\Metable {
        getMeta as traitGetMeta;
    }

    public function saveMetaFromRequest(Request $request, array $metaKeys): void
    {
        foreach ($metaKeys as $metaKey) {
            if ($this->hasMeta($metaKey)) {
                $this->removeMeta($metaKey);
            }
            $meta = data_get($request->validated(), $metaKey);
            if ($meta) {
                $this->setMeta($metaKey, $meta);
            }
        }
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @param string|null $locale
     *
     * @return mixed
     */
    public function getMeta(string $key, $default = null, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $meta = $this->traitGetMeta($key, $default);

        return translatedData($meta, null, $locale);
    }
}
