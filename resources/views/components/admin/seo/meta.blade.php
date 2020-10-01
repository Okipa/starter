<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h2 class="m-0">
            @lang('SEO')
        </h2>
    </div>
    <div class="card-body">
        @php($metaImage = optional($model)->getFirstMedia('seo'))
        {{ inputFile()->name('meta_image')
            ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $metaImage]))
            ->caption(
                (new \App\Models\Pages\PageContent)->getMediaCaption('seo') . '<br>' .
                __('Recommended width: :width pixels / recommended height: :height pixels.', ['width' => 600, 'height' => 600])
            ) }}
        {{ inputText()->name('meta_title')
            ->locales(supportedLocaleKeys())
            ->value(fn($locale) => optional($model)->getMeta('meta_title', null, $locale))
            ->caption(__('Recommended length : around :count characters.', ['count' => 50]))
            ->componentHtmlAttributes(['required']) }}
        {{ textarea()->name('meta_description')
            ->locales(supportedLocaleKeys())
            ->value(fn($locale) => optional($model)->getMeta('meta_description', null, $locale))
            ->caption(__('Recommended length : around :count characters.', ['count' => 150])) }}
    </div>
</div>
