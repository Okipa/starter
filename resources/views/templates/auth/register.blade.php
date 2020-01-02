@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-right']
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-user-plus fa-fw"></i>
        @lang('Registration area')
    </h1>
    <form method="POST" class="w-100" action="{{ route('register.register') }}">
        @csrf
        @include('components.common.form.notice')
        {{ inputText()->name('first_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ inputText()->name('last_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->containerHtmlAttributes(['required']) }}
        {{ inputEmail()->name('email')
            ->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password')
            ->legend(__('passwords.minLength', ['count' => config('security.password.constraint.min')]) . '<br/>'
                . __('passwords.recommendation'))
            ->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password_confirmation')
            ->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Create account'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'load-on-click']) }}
    </form>
    {{ buttonCancel()->route('login') }}
@endsection
