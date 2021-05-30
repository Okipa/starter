<?php

namespace App\View\Components\Front;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use InvalidArgumentException;

class Title extends Component
{
    public const TYPES = [
        'h1' => ['key' => 'h1', 'label' => 'h1'],
        'h2' => ['key' => 'h2', 'label' => 'h2'],
        'h3' => ['key' => 'h3', 'label' => 'h3'],
        'h4' => ['key' => 'h4', 'label' => 'h4'],
        'h5' => ['key' => 'h5', 'label' => 'h5'],
        'h6' => ['key' => 'h6', 'label' => 'h6'],
    ];

    public const STYLES = [
        'h1' => ['key' => 'h1', 'label' => 'h1', 'class' => 'h1'],
        'h2' => ['key' => 'h2', 'label' => 'h2', 'class' => 'h2'],
        'h3' => ['key' => 'h3', 'label' => 'h3', 'class' => 'h3'],
        'h4' => ['key' => 'h4', 'label' => 'h4', 'class' => 'h4'],
        'h5' => ['key' => 'h5', 'label' => 'h5', 'class' => 'h5'],
        'h6' => ['key' => 'h6', 'label' => 'h6', 'class' => 'h6'],
    ];

    public array $type;

    public array $style;

    public function __construct(public string $title, string $typeKey, string $styleKey)
    {
        $this->type = self::STYLES[$typeKey];
        $this->style = self::STYLES[$styleKey];
    }

    public function render(): View
    {
        return match ($this->type['key']) {
            'h1' => view('components.front.title-h1'),
            'h2' => view('components.front.title-h2'),
            'h3' => view('components.front.title-h3'),
            'h4' => view('components.front.title-h4'),
            'h5' => view('components.front.title-h5'),
            'h6' => view('components.front.title-h6'),
            default => throw new InvalidArgumentException('Invalid ' . $this->type['key'] . ' type provided.')
        };
    }
}
