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
    <form method="POST" class="w-100">
        @csrf
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')->componentHtmlAttributes(['autofocus'])->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ inputToggle()->name('remember') }}
        {{ submitValidate()->label(__('Sign me in'))->componentClasses(['form-group', 'btn', 'btn-block', 'btn-primary']) }}
        @php
            $registrationEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration());
            $resetPasswordsEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords());
        @endphp
        @if($registrationEnabled || $resetPasswordsEnabled)
            <div class="d-flex justify-content-between form-group">
                @if($registrationEnabled)
                    <a href="{{ route('register') }}">
                        @lang('Create account')
                    </a>
                @endif
                @if($resetPasswordsEnabled)
                    <a href="{{ route('password.request') }}">
                        @lang('Forgotten password')
                    </a>
                @endif
            </div>
        @endif
        {{ buttonBack()->route('home.page.show') }}
    </form>
@endsection
