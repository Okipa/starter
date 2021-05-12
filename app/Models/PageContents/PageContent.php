<?php

namespace App\Models\PageContents;

use App\Brickables\Carousel;
use App\Brickables\Title;
use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageContent extends Model implements HasMedia, HasBrickables
{
    use HasFactory;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;
    use HasBrickablesTrait;
    use HasSeoMeta;

    public array $brickables = [
        'number_of_bricks' => [
            Carousel::class => ['max' => 1],
            Title::class => ['min' => 1],
        ],
    ];

    /** @var string*/
    protected $table = 'page_contents';

    /** @var array */
    protected $fillable = ['unique_key'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->registerSeoMetaMediaCollection();
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }
}
