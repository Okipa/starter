@extends('layouts.admin.full')
@section('template')
    @include('laravel-brickables::admin.form.title')
    @include('components.common.form.notice')
    @include('laravel-brickables::admin.form.content')
@endsection
