@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ select()->name('type')
        ->options(App\Brickables\Title::TYPES, 'key', 'label')
        ->options(array_map(static fn(array $type) => [
            'key' => $type['key'],
            'label' => __($type['label'])
        ], App\Brickables\Title::TYPES), 'key', 'label')
        ->selectOptions('key', data_get($brick, 'data.background_color'))
        ->componentHtmlAttributes(['required']) }}
    {{ inputText()->name('title')
        ->locales(supportedLocaleKeys())
        ->prepend(null)->value(fn($locale) => translatedData($brick, 'data.title', $locale))
        ->componentHtmlAttributes(['required']) }}
@endsection
