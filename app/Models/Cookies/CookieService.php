<?php

namespace App\Models\Cookies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CookieService extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['title'];

    /** @var string */
    protected $table = 'cookie_services';

    /** @var array */
    protected $fillable = ['title'];
}
