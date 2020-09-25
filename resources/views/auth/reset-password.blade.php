@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    @if($icon = settings()->getFirstMedia('icons'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sync fa-fw"></i>
        @lang('Define new password')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')->componentHtmlAttributes(['autofocus'])->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Save new password'))->componentClasses(['btn', 'btn-block', 'btn-primary']) }}
        {{ buttonBack()->route('login')->containerClasses(['mt-3']) }}
    </form>
@endsection
