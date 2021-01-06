<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('components.admin.forms.card');
    }
}
