<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Plank\Metable\Metable;

class PageContent extends Model
{
    use Metable {
        getMeta as traitGetMeta;
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_contents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
    ];

    /**
     * Add or update the translated meta from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $metaKeys
     */
    public function saveMetaFromRequest(Request $request, array $metaKeys): void
    {
        foreach ($metaKeys as $metaKey) {
            foreach (array_keys(LaravelLocalization::getLocalesOrder()) as $localCode) {
                $localizedMetaKey = $metaKey . '_' . $localCode;
                $localizedMeta = data_get($request->validated(), $localizedMetaKey);
                if ($localizedMeta) {
                    $this->setMeta($localizedMetaKey, $localizedMeta);
                }
            }
        }
    }

    /**
     * Retrieve the translated value of the `Meta` at a given key.
     *
     * @param string $key
     * @param mixed $default Fallback value if no Meta is found.
     *
     * @return mixed
     */
    public function getMeta(string $key, $default = null)
    {
        return $this->traitGetMeta($key . '_' . LaravelLocalization::getCurrentLocale(), $default);
    }
}
