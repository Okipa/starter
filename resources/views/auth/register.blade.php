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
        <i class="fas fa-user-plus fa-fw"></i>
        @lang('Registration area')
    </h1>
    <form method="POST" class="w-100">
        @csrf
        @include('components.common.form.notice')
        {{ inputText()->name('first_name')->prepend('<i class="fas fa-user"></i>')->containerHtmlAttributes(['required']) }}
        {{ inputText()->name('last_name')->prepend('<i class="fas fa-user"></i>')->containerHtmlAttributes(['required']) }}
        {{ inputEmail()->name('email')->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Create account'))->componentClasses(['btn', 'btn-block', 'btn-primary']) }}
        {{ buttonCancel()->route('login')->containerClasses(['mt-3']) }}
    </form>
@endsection
