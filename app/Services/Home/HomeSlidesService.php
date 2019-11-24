<?php

namespace App\Services\Home;

use App\Models\Company;
use App\Models\HomeSlide;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Table;

class HomeSlidesService extends Service implements HomeSlidesServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(HomeSlide::class)->routes([
            'index'   => ['name' => 'home.slides'],
            'create'  => ['name' => 'home.slide.create'],
            'edit'    => ['name' => 'home.slide.edit'],
            'destroy' => ['name' => 'home.slide.destroy'],
        ])->query(function (Builder $query) {
            $query->orderBy('position', 'ASC');
        })->destroyConfirmationHtmlAttributes(function (HomeSlide $homeSlide) {
            return [
                'data-confirm' => __('notifications.message.crud.parent.destroyConfirm', [
                    'parent' => __('entities.home'),
                    'entity' => __('entities.slides'),
                    'name'   => $homeSlide->title,
                ]),
            ];
        });
        $table->column('thumb')->html(function (HomeSlide $homeSlide) {
            return view('components.admin.table.image', ['image' => $homeSlide->getFirstMedia('illustrations')]);
        });
        $table->column('title')->stringLimit(50);
        $table->column('description')->stringLimit(150);
        $table->column('position')->html(function (HomeSlide $homeSlide) {
            return '<span class="d-none id">' . $homeSlide->id . '</span>'
                . '<span class="position">' . $homeSlide->position . '</span>';
        });
        $table->column('active')->sortable()->html(function (HomeSlide $homeSlide) {
            return view('components.admin.table.active', [
                'active' => $homeSlide->active,
            ]);
        });

        return $table;
    }
}
