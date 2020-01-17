@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text')->locales(supportedLocaleKeys())->prepend(false)->value(function($locale) use($brick) {
        return data_get($brick, 'data.text.' . $locale);
    })->componentClasses(['editor'])->containerHtmlAttributes(['required']) }}
@endsection
