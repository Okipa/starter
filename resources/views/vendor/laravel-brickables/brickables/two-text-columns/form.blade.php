@extends('laravel-brickables::admin.form')
@section('inputs')
    {{ textarea()->name('left_content')->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
    {{ textarea()->name('right_content')->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
@endsection
