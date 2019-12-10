<?php

namespace App\Models;

use Illuminate\Http\Request;

abstract class Metable extends Model
{
    use \Plank\Metable\Metable {
        getMeta as traitGetMeta;
    }

    /**
     * Add or update the translated meta from the request.
     *
     * @param Request $request
     * @param array $metaKeys
     */
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
     * Retrieve the translated value of the `Meta` at a given key.
     *
     * @param string $key
     * @param mixed $default Fallback value if no Meta is found.
     * @param null $locale
     *
     * @return mixed
     */
    public function getMeta(string $key, $default = null, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return multilingual()
            ? data_get($this->traitGetMeta($key, $default), $locale, $default)
            : $this->traitGetMeta($key, $default);
    }
}
