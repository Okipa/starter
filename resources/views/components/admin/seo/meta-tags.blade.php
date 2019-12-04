<h3 class="pt-4">@lang('admin.section.seo')</h3>
{{ bsText()->name('meta_title')
    ->locales($supportedLocales)
    ->value(optional($model)->getMeta('meta_title'))
    ->legend(__('static.legend.meta.title'))
    ->containerHtmlAttributes(['required']) }}
{{ bsTextarea()->name('meta_description')
    ->locales($supportedLocales)
    ->value(optional($model)->getMeta('meta_description'))
    ->legend(__('static.legend.meta.description')) }}
