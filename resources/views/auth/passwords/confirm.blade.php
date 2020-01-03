@extends('layouts.admin.auth')
@section('content')
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-right'],
        'dropdownClass' => ['dropdown-menu-right'],
        'labelClass' => ['btn', 'btn-link']
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-shield-alt fa-fw"></i>
        @lang('Password verification')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.reconfirm') }}">
        @csrf
        @include('components.common.form.notice')
        <p>@lang('For security reasons, please confirm your password. You will not be asked for several hours.')</p>
        {{ inputPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Confirm password'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'load-on-click']) }}
        <div class="form-group d-block">
            <a href="{{ route('password.request') }}">
                @lang('Forgotten password')
            </a>
        </div>
    </form>
    {{ buttonCancel() }}
@endsection
