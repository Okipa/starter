@extends('laravel-brickables::admin.form')
@section('inputs')
    {{ textarea()->name('content')->locales(supportedLocaleKeys())->prepend(false) }}
@endsection
