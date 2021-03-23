<?php

namespace App\Models\Cookies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class CookieCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['title', 'description'];

    /** @var string */
    protected $table = 'cookie_categories';

    /** @var array */
    protected $fillable = ['title', 'description'];
}
