@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Media library'), 'entity' => __('Categories')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        {{ $table }}
    </x-admin.forms.card>
@endsection
