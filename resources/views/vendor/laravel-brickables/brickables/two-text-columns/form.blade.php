@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: replace `translatedData` by `data_get` if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
    {{ textarea()->name('text_right')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: replace `translatedData` by `data_get` if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_right', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
@endsection
