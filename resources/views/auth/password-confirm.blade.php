@extends('layouts.admin.auth')
@section('content')
    @if($errors->any())
        @php
            toast(__('notify.invalid'), 'error');
        @endphp
    @endif
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-end'],
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
        {{ submitValidate()->label(__('Confirm password'))
            ->componentClasses(['btn-primary', 'mb-3'])
            ->containerClasses(['d-grid']) }}
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords()))
            <div class="mb-3">
                <a href="{{ route('password.request') }}">
                    {{ __('Forgotten password') }}
                </a>
            </div>
        @endif
        {{ buttonCancel() }}
    </form>
@endsection
