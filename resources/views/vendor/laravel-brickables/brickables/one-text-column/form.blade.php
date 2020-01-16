@extends('laravel-brickables::admin.form')
@section('inputs')
    {{ textarea()->name('text')->value(function($locale) use($brick) {
        return optional($brick)->data['text'][$locale];
    })->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
@endsection
