<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class SeoMetaCard extends Component
{
    public function __construct(public ?Model $model)
    {
        //
    }

    public function render(): View
    {
        return view('components.admin.forms.seo-meta-card');
    }
}
