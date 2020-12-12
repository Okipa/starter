@if (session('status') === 'verification-link-sent')
    @php
        alert()->html(__('Success'), __('A new verification link has been sent to the email address you provided during registration.'), 'success')->showConfirmButton()
    @endphp
@endif
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
        <i class="fas fa-sign-in-alt fa-fw"></i>
        @lang('Email address verification')
    </h1>
    <p>
        @lang('We need to ensure that your email address is valid.')
    </p>
    <p>
        @lang('Could you verify it by clicking on the link we just emailed to you?')
    </p>
    <p>
        @lang('If you didn\'t receive the email, we will gladly send you another.')
    </p>
    <form method="POST" action="{{ route('verification.send') }}" novalidate>
        @csrf
        {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')->label(__('Resend Verification Email')) }}
    </form>
@endsection
