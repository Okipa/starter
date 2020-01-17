@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('left_text')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use ($brick) {
        return data_get($brick, 'data.left_text.' . $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
    {{ textarea()->name('right_text')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use ($brick) {
        return data_get($brick, 'data.right_text.' . $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
@endsection
