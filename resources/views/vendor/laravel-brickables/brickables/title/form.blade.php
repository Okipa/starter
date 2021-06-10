@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ select()->name('type')
        // ToDo: remove array_map if your app is not multilingual.
        ->options(array_map(static fn(array $type) => [
            'key' => $type['key'],
            'label' => __($type['label'])
        ], App\View\Components\Front\Title::TYPES), 'key', 'label')
        ->selectOptions('key', data_get($brick, 'data.type'))
        ->componentHtmlAttributes(['required']) }}
    {{ select()->name('style')
        ->prepend('<i class="fas fa-paint-brush"></i>')
        // ToDo: remove array_map if your app is not multilingual.
        ->options(array_map(static fn(array $type) => [
            'key' => $type['key'],
            'label' => __($type['label'])
        ], App\View\Components\Front\Title::STYLES), 'key', 'label')
        ->selectOptions('key', data_get($brick, 'data.style'))
        ->componentHtmlAttributes(['required']) }}
    {{ inputText()->name('title')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        // ToDo: replace `translatedData` by `data_get` if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.title', $locale))
        ->componentHtmlAttributes(['required']) }}
@endsection
