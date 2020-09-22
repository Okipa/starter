<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryMediaFileFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaFile::class;

    protected array $media = ['audio.mp3', 'file.ods', 'file.pdf', 'image.jpg', 'video.mp4'];

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return ['name' => ['fr' => Str::title($faker->word), 'en' => Str::title($faker->word)]];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (LibraryMediaFile $file) {
            $file->category_id = $file->category_id
                ?: LibraryMediaCategory::inRandomOrder()->first()->id;
        })->afterCreating(function (LibraryMediaFile $file) {
            $mediaPath = $this->media[array_rand($this->media, 1)];
            $file->addMedia(database_path('seeders/files/library-media/' . $mediaPath))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }
}
