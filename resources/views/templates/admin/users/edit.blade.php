@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        @if($user)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Users')])
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
        <p>
            @include('components.common.form.notice')
        </p>
        <div class="card-columns">
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Identity')
                    </h2>
                </div>
                <div class="card-body">
                    @php($profilePicture = optional($user)->getFirstMedia('profile_pictures'))
                    {{ inputFile()->name('profile_picture')
                        ->value(optional($profilePicture)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $profilePicture]))
                        ->caption((new \App\Models\Users\User)->getMediaCaption('profile_pictures')) }}
                    {{ inputText()->name('last_name')->model($user)->componentHtmlAttributes(['required']) }}
                    {{ inputText()->name('first_name')->model($user)->componentHtmlAttributes(['required']) }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Contact')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputTel()->name('phone_number')->model($user) }}
                    {{ inputEmail()->name('email')->model($user)->componentHtmlAttributes(['required']) }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Security')
                    </h2>
                </div>
                <div class="card-body">
                    <p>
                        @if(currentRouteIs('user.create'))
                            <i class="fas fa-exclamation-triangle fa-fw text-warning"></i>
                            @lang('If no password is defined for this user, he will be emailed a password creation link.')
                        @else
                            @lang('Only fill if you want to change the current password.')
                        @endif
                    </p>
                    {{ inputPassword()->name($user ? 'new_password' : 'password') }}
                    {{ inputPassword()->name($user ? 'new_password_confirmation' : 'password_confirmation')->model($user) }}
                </div>
            </div>
        </div>
    </form>
@endsection
