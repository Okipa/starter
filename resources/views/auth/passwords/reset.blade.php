@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    @if($icon = settings()->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sync fa-fw"></i>
        @lang('Define new password')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.reset') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')->componentHtmlAttributes(['autofocus'])->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password')
            ->legend(__('passwords.minLength', ['count' => config('security.password.constraint.min')]) . '<br/>'
                . __('passwords.recommendation'))
            ->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Save new password'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary']) }}
    </form>
    {{ buttonBack()->route('login') }}
@endsection
