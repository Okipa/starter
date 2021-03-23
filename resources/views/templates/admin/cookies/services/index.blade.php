@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-laptop-code fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <p>
            {{ __('Please note that you are responsible for complying with the GDPR law on this platform.') }}<br>
            {{ __('For this purpose, you must configure all services using cookies and collecting data from your users on this interface.') }}
        </p>
        <p>
            {{ __('To help you during this configuration process, you can read the documentation of the used CMP tool:') }}
            <a href="https://heyklaro.com/docs" title="GDPR" target="_blank" rel="noopener">https://heyklaro.com/docs</a>.<br>
            {{ __('You will also find all the necessary information about GDPR law on this resource:') }}
            <a href="https://gdpr.eu" title="GDPR" target="_blank" rel="noopener">https://gdpr.eu</a>.
        </p>
        {{ $table }}
    </x-admin.forms.card>
@endsection
