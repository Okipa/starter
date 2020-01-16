@extends('laravel-brickables::admin.form')
@section('inputs')
    {{ textarea()->name('left_text')->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
    {{ textarea()->name('right_text')->locales(supportedLocaleKeys())->prepend(false)->componentClasses(['editor']) }}
@endsection
