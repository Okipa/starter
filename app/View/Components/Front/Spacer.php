<?php

namespace App\View\Components\Front;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spacer extends Component
{
    public const TYPES = [
        'xl' => ['key' => 'xl', 'label' => 'Extra large', 'classes' => 'mb-4 mb-md-5 pb-4 pb-md-5'],
        'lg' => ['key' => 'lg', 'label' => 'Large', 'classes' => 'mb-3 mb-md-4 pb-4 pb-md-5'],
        'md' => ['key' => 'md', 'label' => 'Medium', 'classes' => 'mb-3 mb-md-4 pb-3 pb-md-4'],
        'sm' => ['key' => 'sm', 'label' => 'Small', 'classes' => 'mb-2 mb-md-3 pb-3 pb-md-4'],
        'xs' => ['key' => 'xs', 'label' => 'Extra small', 'classes' => 'mb-2 mb-md-3 pb-2 pb-md-3'],
    ];

    public array $type;

    public function __construct(string $typeKey)
    {
        $this->type = self::TYPES[$typeKey];
    }

    public function render(): View
    {
        return view('components.front.spacer');
    }
}
