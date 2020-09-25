@extends('layouts.admin.auth')
@section('content')
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
        <i class="fas fa-shield-alt fa-fw"></i>
        @lang('Password verification')
    </h1>
    <form method="POST" class="w-100">
        @csrf
        @include('components.common.form.notice')
        <p>@lang('For security reasons, please confirm your password. You will not be asked for several hours.')</p>
        {{ inputPassword()->name('password')->containerHtmlAttributes(['required']) }}
        {{ submitValidate()->label(__('Confirm password'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary']) }}
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords()))
            <div class="form-group d-block mt-3">
                <a href="{{ route('password.request') }}">
                    @lang('Forgotten password')
                </a>
            </div>
        @endif
        {{ buttonCancel() }}
    </form>
@endsection
