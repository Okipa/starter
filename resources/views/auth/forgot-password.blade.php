@extends('layouts.admin.auth')
@section('content')
    @if(session('status'))
        @php
            alert()->html(__('Success'), session('status'), 'success')->showConfirmButton()
        @endphp
    @endif
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
        <i class="fas fa-unlock-alt fa-fw"></i>
        @lang('Forgotten password')
    </h1>
    <p>
        @lang('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')
    </p>
    <form method="POST" class="w-100" action="{{ route('password.email') }}">
        @csrf
        @include('components.common.form.notice')
        {{ inputEmail()->name('email')
            ->caption(__('Fill in your email to receive instructions for resetting your password.'))
            ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'email']) }}
        {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')
            ->label(__('Send reset email'))
            ->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        {{ buttonCancel()->route('login') }}
    </form>
@endsection
