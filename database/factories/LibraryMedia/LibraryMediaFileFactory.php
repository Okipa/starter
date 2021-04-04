<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LibraryMediaFileFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaFile::class;

    public function definition(): array
    {
        return [
            'name' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }

    public function image(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia($this->faker->image())
                ->toMediaCollection('media');
        });
    }

    public function pdf(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/file.pdf'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function video(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/video.mp4'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function audio(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/audio.mp3'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function doc(): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/doc.odt'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function withCategory(): self
    {
        return $this->afterMaking(function (LibraryMediaFile $file) {
            $categories = LibraryMediaCategory::get();
            $file->category_id = $categories->random(1)->first()->id;
        });
    }
}
