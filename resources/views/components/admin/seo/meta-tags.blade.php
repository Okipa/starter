<h3 class="pt-4">@lang('admin.section.seo')</h3>
{{ bsText()->name('meta_title')
    ->locales(supportedLocaleKeys())
    ->value(function($locale) use ($model) {
        return optional($model)->getMeta('meta_title', null, $locale);
    })
    ->legend(__('static.legend.meta.title'))
    ->containerHtmlAttributes(['required']) }}
{{ bsTextarea()->name('meta_description')
    ->locales(supportedLocaleKeys())
    ->value(function($locale) use ($model) {
        return optional($model)->getMeta('meta_description', null, $locale);
    })
    ->legend(__('static.legend.meta.description')) }}
