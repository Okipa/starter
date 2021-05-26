@extends('layouts.admin.auth')
@section('content')
    @if(session('status'))
        @php
            alert()->html(__('Success'), session('status'), 'success')->showConfirmButton()
        @endphp
    @endif
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-unlock-alt fa-fw"></i>
        {{ __('Forgotten password') }}
    </h1>
    <p>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>
    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf
        <x-common.forms.notice class="mt-3"/>
        {{ inputEmail()->name('email')
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'email']) }}
        {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')
            ->label(__('Send reset email'))
            ->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        {{ buttonCancel()->route('login') }}
    </form>
@endsection
