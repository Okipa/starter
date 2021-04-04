@extends('layouts.admin.auth')
@section('content')
    @if($errors->any())
        @php
            toast(__('notify.invalid'), 'error');
        @endphp
    @endif
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-shield-alt fa-fw"></i>
        {{ __('Password verification') }}
    </h1>
    <form method="POST" novalidate>
        @csrf
        <x-common.forms.notice class="mt-3"/>
        <p>{{ __('For security reasons, please confirm your password. You will not be asked for several hours.') }}</p>
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'current-password']) }}
        {{ submitValidate()->label(__('Confirm password'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords()))
            <div class="form-group">
                <a href="{{ route('password.request') }}">
                    {{ __('Forgotten password') }}
                </a>
            </div>
        @endif
        {{ buttonCancel() }}
    </form>
@endsection
