@if(session('status'))
    @php
        alert()->html(__('Success'), session('status'), 'success')->showConfirmButton();
    @endphp
@endif
@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right', 'mb-3'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-right']
    ])
    @if($icon = settings()->getFirstMedia('icons'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        @lang('Sign in area')
    </h1>
    <form class="w-100" method="POST" novalidate>
        @csrf
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'email']) }}
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'current-password']) }}
        {{ inputSwitch()->name('remember') }}
        {{ submitValidate()->label(__('Login'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        @php
            $registrationEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration());
            $resetPasswordsEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords());
        @endphp
        @if($registrationEnabled || $resetPasswordsEnabled)
            <div class="d-flex justify-content-between form-group">
                @if($registrationEnabled)
                    <a href="{{ route('register') }}" title="@lang('Create account')">
                        @lang('Create account')
                    </a>
                @endif
                @if($resetPasswordsEnabled)
                    <a href="{{ route('password.request') }}" title="@lang('Forgotten password')">
                        @lang('Forgotten password')
                    </a>
                @endif
            </div>
        @endif
        {{ buttonBack()->route('home.page.show') }}
    </form>
@endsection
