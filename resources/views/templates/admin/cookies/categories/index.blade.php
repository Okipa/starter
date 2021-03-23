@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Cookies'), 'entity' => __('Categories')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <p>
            {{ __('Cookie categories are gathering cookie services with similar purpose in order to allow users to easily identify them.') }}
        </p>
        {{ $table }}
    </x-admin.forms.card>
@endsection
