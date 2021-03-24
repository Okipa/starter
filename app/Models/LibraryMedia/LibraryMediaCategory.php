<?php

namespace App\Models\LibraryMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class LibraryMediaCategory extends Model
{
    use hasFactory;
    use HasTranslations;

    public array $translatable = ['title'];

    /** @var string*/
    protected $table = 'library_media_categories';

    /** @var array */
    protected $fillable = ['title'];

    public function files(): HasMany
    {
        return $this->hasMany(LibraryMediaFile::class, 'category_id', 'id');
    }
}
