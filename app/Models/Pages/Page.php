<?php

namespace App\Models\Pages;

use App\Models\Metable;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Metable implements HasBrickables
{
    use HasTranslations;
    use HasBrickablesTrait;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = ['url', 'title', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'url',
        'title',
        'description',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->getTranslation('url', app()->getLocale());
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('url->' . app()->getLocale(), $value)->firstOrFail();
    }
}
