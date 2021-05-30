@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: remove localization if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
    {{ textarea()->name('text_center')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: remove localization if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_center', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
    {{ textarea()->name('text_right')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: remove localization if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_right', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
@endsection
