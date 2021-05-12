<?php

namespace Database\Factories\Traits;

use App\Brickables\Carousel;
use App\Brickables\ColoredBackgroundContainer;
use App\Brickables\OneColumnTextOneColumnImage;
use App\Brickables\OneTextColumn;
use App\Brickables\ThreeTextColumns;
use App\Brickables\Title;
use App\Brickables\TwoTextColumns;
use App\Models\Brickables\CarouselBrickSlide;
use Closure;
use Illuminate\Support\Str;
use Okipa\LaravelBrickables\Contracts\HasBrickables;

trait HasBricks
{
    /**
     * @param array $slides
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Exception
     */
    public function withCarouselBrick(array $slides = []): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($slides) {
            $carouselBrick = $model->addBrick(Carousel::class, ['full_width' => true]);
            $slidesCount = $slides ? count($slides) : random_int(1, 3);
            $data = ['brick_id' => $carouselBrick->id, 'active' => true];
            for ($ii = 0; $ii <= $slidesCount; $ii++) {
                foreach (supportedLocaleKeys() as $localeKey) {
                    $data['label'][$localeKey] = data_get($slides, $ii . '.label.' . $localeKey)
                        ?: Str::title($this->faker->words(random_int(1, 3), true));
                    $data['caption'][$localeKey] = data_get($slides, $ii . '.caption.' . $localeKey)
                        ?: Str::title($this->faker->words(random_int(4, 7), true));
                }
                $slide = CarouselBrickSlide::create($data);
                $slide->addMedia(data_get($slides, $ii . '.image') ?: $this->faker->image(null, 2560, 700))
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        });
    }

    /**
     * @param string $type
     * @param array $title
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     * @throws \Exception
     */
    public function withTitleBrick(string $type = 'h1', array $title = []): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($type, $title) {
            $data = ['type' => Title::TYPES[$type]['key']];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['title'][$localeKey] = data_get($title, $localeKey)
                    ?: Str::title($this->faker->words(random_int(1, 3), true));
            }
            $model->addBrick(Title::class, $data);
        });
    }

    /**
     * @param array $text
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function withOneTextColumnBrick(array $text = []): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($text) {
            $data = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['text'][$localeKey] = data_get($text, $localeKey) ?: $this->faker->realText(800);
            }
            $model->addBrick(OneTextColumn::class, $data);
        });
    }

    /**
     * @param array $text
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function withTwoTextColumnsBrick(array $text = []): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($text) {
            $data = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['text_left'][$localeKey] = data_get($text, 'text_left.' . $localeKey)
                    ?: $this->faker->realText(500);
                $data['text_right'][$localeKey] = data_get($text, 'text_right.' . $localeKey)
                    ?: $this->faker->realText(500);
            }
            $model->addBrick(TwoTextColumns::class, $data);
        });
    }

    /**
     * @param array $text
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function withThreeTextColumnsBrick(array $text = []): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($text) {
            $data = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['text_left'][$localeKey] = data_get($text, 'text_left.' . $localeKey)
                    ?: $this->faker->realText(300);
                $data['text_center'][$localeKey] = data_get($text, 'text_center.' . $localeKey)
                    ?: $this->faker->realText(300);
                $data['text_right'][$localeKey] = data_get($text, 'text_right.' . $localeKey)
                    ?: $this->faker->realText(300);
            }
            $model->addBrick(ThreeTextColumns::class, $data);
        });
    }

    /**
     * @param array $text
     * @param string|null $image
     * @param bool $invertOrder
     *
     * @return \Database\Factories\Pages\PageFactory|\Database\Factories\PageContents\PageContentFactory|\Database\Factories\Traits\HasBricks
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function withOneColumnTextOneColumnImageBrick(array $text = [], string $image = null, bool $invertOrder = false): self
    {
        return $this->afterCreating(function (HasBrickables $model) use ($text, $image, $invertOrder) {
            $data = ['invert_order' => $invertOrder];
            foreach (supportedLocaleKeys() as $localeKey) {
                $data['text'][$localeKey] = data_get($text, $localeKey) ?: $this->faker->realText(500);
            }
            $oneColumnTextOneColumnImage = $model->addBrick(OneColumnTextOneColumnImage::class, $data);
            /** @var \Spatie\MediaLibrary\HasMedia $oneColumnTextOneColumnImage */
            $oneColumnTextOneColumnImage->addMedia($image ?: $this->faker->image(null, 540, 400))
                ->preservingOriginal()
                ->toMediaCollection('images');
        });
    }

    /**
     * @param \Closure $addSubBricks
     * @param string $backgroundColor
     * @param string $alignment
     *
     * @return $this
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function withColoredBackgroundContainerBrick(
        Closure $addSubBricks,
        string $backgroundColor = 'gray_light',
        string $alignment = 'left',
    ): self {
        return $this->afterCreating(function (HasBrickables $model) use ($backgroundColor, $alignment, $addSubBricks) {
            /** @var \App\Models\Brickables\ColoredBackgroundContainerBrick $coloredBackgroundContainerBrick */
            $coloredBackgroundContainerBrick = $model->addBrick(ColoredBackgroundContainer::class, [
                'background_color' => ColoredBackgroundContainer::BACKGROUND_COLORS[$backgroundColor]['key'],
                'alignment' => ColoredBackgroundContainer::ALIGNMENTS[$alignment]['key'],
            ]);
            $addSubBricks($coloredBackgroundContainerBrick);
        });
    }
}
