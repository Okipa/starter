<h3 class="pt-4">@lang('SEO')</h3>
{{ bsText()->name('meta_title')
    ->locales(supportedLocaleKeys())
    ->value(function($locale) use ($model) {
        return optional($model)->getMeta('meta_title', null, $locale);
    })
    ->legend(__('Recommended length : ~ :count characters.', ['count' => 50]))
    ->containerHtmlAttributes(['required']) }}
{{ bsTextarea()->name('meta_description')
    ->locales(supportedLocaleKeys())
    ->value(function($locale) use ($model) {
        return optional($model)->getMeta('meta_description', null, $locale);
    })
    ->legend(__('Recommended length : ~ :count characters.', ['count' => 150])) }}
