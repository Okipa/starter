@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
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
        <i class="fas fa-sync fa-fw"></i>
        @lang('Define a new password')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.reset') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        @include('components.common.form.notice')
        {{ bsEmail()->name('email')->componentHtmlAttributes(['autofocus'])->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password')
            ->legend(__('static.legend.password.constraint.min', ['count' => config('security.password.constraint.min')]) . '<br/>'
                . __('static.legend.password.recommendation'))
            ->containerHtmlAttributes(['required']) }}
        {{ bsPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('Save my new password'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'load-on-click']) }}
    </form>
    {{ bsBack()->route('login') }}
@endsection
