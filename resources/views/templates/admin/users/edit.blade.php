@extends('layouts.admin.full')
@php
    switch(request()->route()->getName()){
        case 'user.create' :
            $title = __('breadcrumbs.orphan.create', ['entity' => __('Users')]);
            $action = route('user.store');
            break;
        case 'user.edit' :
            $title = __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->name]);
            $action = route('user.update', $user);
            break;
        case 'user.profile.edit' :
            $title = __('My profile');
            $action = route('user.update', $user);
            break;
    }
@endphp
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        {{ $title }}
    </h1>
    <hr>
    <form class="mb-3"
          action="{{ $action }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($user)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Identity')</h3>
                @php($avatar = optional($user)->getFirstMedia('avatar'))
                {{ bsFile()->name('avatar')
                    ->value(optional($avatar)->file_name)
                    ->uploadedFile(function() use ($avatar) {
                        return $avatar
                            ? image()->src(optional($avatar)->getUrl('thumb'))
                                ->linkUrl(optional($avatar)->getUrl('profile'))
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->legend((new App\Models\User)->constraintsLegend('avatar')) }}
                {{ bsText()->name('last_name')->model($user)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('first_name')->model($user)->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('Contact')</h3>
                {{ bsEmail()->name('email')->model($user)->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('Security')</h3>
                {{ bsPassword()->name($user ? 'new_password' : 'password')
                    ->legend(
                        __('passwords.minLength', ['count' => config('security.password.constraint.min')]) . '<br/>'
                        . __('passwords.recommendation') . '<br/>'
                        . __('passwords.fillForUpdate')
                    )
                    ->containerHtmlAttributes($user ? [] : ['required'])  }}
                {{ bsPassword()->name($user ? 'new_password_confirmation' : 'password_confirmation')
                    ->model($user)
                    ->containerHtmlAttributes($user ? [] : ['required']) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('users.index')->containerClasses(['mr-2']) }}
                    @if($user){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
