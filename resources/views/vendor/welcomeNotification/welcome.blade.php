@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    @if($icon = settings()->getFirstMedia('icons'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-hand-spock fa-fw"></i>
        @lang('Welcome')
    </h1>
    <form method="POST" class="w-100">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}"/>
        @include('components.common.form.notice')
        <p>@lang('Welcome on :app ! To be able to login to your new account please define a secured password with the fields bellow.', ['app' => config('app.name')])</p>
        {{ inputPassword()->name('password')
            ->caption(__('passwords.minLength', ['count' => config('security.password.constraint.min')]) . '<br/>'
                . __('passwords.recommendation'))
            ->containerHtmlAttributes(['required']) }}
        {{ inputPassword()->name('password_confirmation')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Save new password'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary']) }}
        {{ buttonCancel()->route('home.page.show')->containerClasses(['mt-3']) }}
    </form>
@endsection
