<x-admin.forms.card title="{{ __('SEO') }}">
    @php($metaImage = optional($model)->getFirstMedia('seo'))
    {{ inputFile()->name('meta_image')
        ->value(optional($metaImage)->file_name)
        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $metaImage]))
        ->caption(app(App\Models\PageContents\PageContent::class)->getMediaCaption('seo')) }}
    {{ inputText()->name('meta_title')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->value(fn($locale) => optional($model)->getMeta('meta_title', null, $locale))
        ->caption(__('Recommended length : around :count characters.', ['count' => 50]))
        ->componentHtmlAttributes(['required']) }}
    {{ textarea()->name('meta_description')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->value(fn($locale) => optional($model)->getMeta('meta_description', null, $locale))
        ->caption(__('Recommended length : around :count characters.', ['count' => 150])) }}
</x-admin.forms.card>
