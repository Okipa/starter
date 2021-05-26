@extends('layouts.admin.auth')
@section('content')
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-hand-spock fa-fw"></i>
        {{ __('Welcome') }}
    </h1>
    <form method="POST" novalidate>
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}"/>
        <x-common.forms.notice class="mt-3"/>
        <p>{{ __('Welcome on :app ! To be able to login to your new account please define a secured password with the fields bellow.', ['app' => config('app.name')]) }}</p>
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'new-password'])
            ->containerHtmlAttributes(['data-password-strength-meter']) }}
        {{ inputPassword()->name('password_confirmation')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
        {{ submitValidate()->label(__('Save new password'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        {{ buttonCancel()->route('home.page.show') }}
    </form>
@endsection
