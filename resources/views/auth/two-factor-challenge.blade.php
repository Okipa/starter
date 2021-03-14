@if(session('status'))
    @php
        alert()->html(__('Success'), session('status'), 'success')->showConfirmButton();
    @endphp
@endif
@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-end']
    ])
    @if($icon = settings()->getFirstMedia('icons'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        {{ __('Two Factor Authentication') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <p>
        @if(request()->recovery)
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        @else
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        @endif
    </p>
    <form method="POST" novalidate>
        @csrf
        @if(request()->recovery)
            {{ inputText()->prepend('<i class="fas fa-code"></i>')
                ->name('recovery_code')
                ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'one-time-code']) }}
        @else
            {{ inputText()->prepend('<i class="fas fa-code"></i>')
                ->name('code')
                ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'one-time-code']) }}
        @endif
        {{ submit()->prepend('<i class="fas fa-sign-in-alt fa-fw"></i>')
            ->label(__('Log in'))
            ->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        <div class="d-flex form-group">
            @if(request()->recovery)
                <a href="{{ route(Request::route()->getName()) }}" title="{{ __('Use an authentication code') }}">
                    <i class="fas fa-exchange-alt fa-fw"></i>
                    {{ __('Use an authentication code') }}
                </a>
            @else
                <a href="{{ route(Request::route()->getName(), ['recovery' => true]) }}" title="{{ __('Use a recovery code') }}">
                    <i class="fas fa-exchange-alt fa-fw"></i>
                    {{ __('Use a recovery code') }}
                </a>
            @endif
        </div>
        {{ buttonBack()->route('home.page.show') }}
    </form>
@endsection
