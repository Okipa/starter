<?php

namespace App\Models\LibraryMedia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class LibraryMediaCategory extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'library_media_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function files(): HasMany
    {
        return $this->hasMany(LibraryMediaFile::class, 'category_id', 'id');
    }
}
