<?php

namespace App\View\Components\Front;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TitleH4 extends Component
{
    public function __construct(public string $title)
    {
        //
    }

    public function render(): View
    {
        return view('components.front.title-h4');
    }
}
