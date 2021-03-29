@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        @if($user)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Users')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $user ? route('user.update', $user) : route('user.store') }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if($user)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('users.index')->containerClasses(['mr-3']) }}
            @if($user){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Civil status') }}">
                    @php($profilePicture = optional($user)->getFirstMedia('profile_pictures'))
                    {{ inputFile()->name('profile_picture')
                        ->value(optional($profilePicture)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $profilePicture]))
                        ->caption((new \App\Models\Users\User)->getMediaCaption('profile_pictures')) }}
                    {{ inputText()->name('last_name')->model($user)->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('first_name')->model($user)->componentHtmlAttributes(['required']) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Contact') }}">
                    {{ inputTel()->name('phone_number')->model($user) }}
                    {{ inputEmail()->name('email')->model($user)->componentHtmlAttributes(['required']) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Security') }}">
                    <p>
                        @if(currentRouteIs('user.create'))
                            <i class="fas fa-exclamation-triangle fa-fw text-warning"></i>
                            {{ __('If no password is defined for this user, he will be emailed a password creation link.') }}
                        @else
                            {{ __('Only fill if you want to change the current password.') }}
                        @endif
                    </p>
                    {{ inputPassword()->name($user ? 'new_password' : 'password') }}
                    {{ inputPassword()->name($user ? 'new_password_confirmation' : 'password_confirmation')->model($user) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
