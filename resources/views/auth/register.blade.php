@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right', 'mb-3'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-right']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_square')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-user-plus fa-fw"></i>
        {{ __('Registration area') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <form method="POST" novalidate>
        @csrf
        {{ inputText()->name('first_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'given-name']) }}
        {{ inputText()->name('last_name')
            ->prepend('<i class="fas fa-user"></i>')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'family-name']) }}
        {{ inputEmail()->name('email')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'email']) }}
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
        {{ inputPassword()->name('password_confirmation')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
        {{ submitValidate()->label(__('Create account'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        {{ buttonCancel()->route('login') }}
    </form>
@endsection
