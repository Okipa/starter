<h3>@lang('SEO')</h3>
@php($metaImage = optional($model)->getFirstMedia('seo'))
{{ inputFile()->name('meta_image')
    ->uploadedFile(fn() => $metaImage ? image()->src($metaImage->getUrl('thumb'))->linkUrl($metaImage->getUrl())->linkTitle($metaImage->name) : null)
    ->caption(
        (new \App\Models\Pages\PageContent)->getMediaCaption('seo') . '<br>' .
        __('Recommended width: :width pixels / recommended height: :height pixels.', ['width' => 600, 'height' => 600])
    ) }}
{{ inputText()->name('meta_title')
    ->locales(supportedLocaleKeys())
    ->value(fn($locale) => optional($model)->getMeta('meta_title', null, $locale))
    ->caption(__('Recommended length : around :count characters.', ['count' => 50]))
    ->containerHtmlAttributes(['required']) }}
{{ textarea()->name('meta_description')
    ->locales(supportedLocaleKeys())
    ->value(fn($locale) => optional($model)->getMeta('meta_description', null, $locale))
    ->caption(__('Recommended length : around :count characters.', ['count' => 150])) }}
