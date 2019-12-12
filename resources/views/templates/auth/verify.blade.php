@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.switcher', [
        'containerClasses' => ['text-right'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-right']
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        @lang('Email address verification')
    </h1>
    <p>
        @lang('You are seeing this message because your e-mail address has not been validated yet.')
    </p>
    <p>
        @lang('First, make sure you have not already received your verification link by e-mail.')
    </p>
    <p>
        @lang('You can\'t find it? Click the button below to receive a new one.')
    </p>
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        {{ bsValidate()->label(__('Send new verification link'))->prepend('<i class="fas fa-paper-plane fa-fw"></i>')}}
    </form>
@endsection
