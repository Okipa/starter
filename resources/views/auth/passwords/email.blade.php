@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-unlock-alt fa-fw"></i>
        @lang('Forgotten password')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.email') }}">
        @csrf
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')
            ->legend(__('Fill in your e-mail to receive instructions for resetting your password.'))
            ->componentHtmlAttributes(['autofocus'])
            ->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Send reset e-mail'))->componentClasses(['btn', 'btn-block', 'btn-primary', 'load-on-click']) }}
    </form>
    {{ buttonCancel()->route('login') }}
@endsection
