@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
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
    <div>
        @lang('auth.label.beforeResendingVerificationLink')
    </div>
    <div>
        @lang('auth.label.didNotReceivedVerificationLink')
    </div>
    <form class="mt-3" method="POST" action="{{ route('verification.resend') }}">
        {{ bsValidate()->label(__('auth.label.newVerificationEmail'))->prepend('<i class="fas fa-paper-plane fa-fw"></i>')}}
    </form>
@endsection
