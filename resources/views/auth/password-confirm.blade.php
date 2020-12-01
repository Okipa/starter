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
    <form class="w-100" method="POST" novalidate>
        @csrf
        @include('components.common.form.notice')
        <p>@lang('For security reasons, please confirm your password. You will not be asked for several hours.')</p>
        {{ inputPassword()->name('password')
            ->componentHtmlAttributes(['required', 'autocomplete' => 'current-password']) }}
        {{ submitValidate()->label(__('Confirm password'))->componentClasses(['btn-block', 'btn-primary', 'form-group']) }}
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords()))
            <div class="form-group">
                <a href="{{ route('password.request') }}">
                    @lang('Forgotten password')
                </a>
            </div>
        @endif
        {{ buttonCancel() }}
    </form>
@endsection
