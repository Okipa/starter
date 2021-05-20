@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-end'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sync fa-fw"></i>
        {{ __('Define new password') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <form method="POST" action="{{ route('password.update') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        {{ inputEmail()->name('email')
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'username']) }}
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password'])
            ->containerHtmlAttributes(['data-password-strength-meter']) }}
        {{ inputPassword()->name('password_confirmation')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
        {{ submitValidate()->label(__('Save new password'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        {{ buttonBack()->route('login') }}
    </form>
@endsection
