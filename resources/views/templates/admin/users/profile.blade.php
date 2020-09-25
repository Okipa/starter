@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        @lang('Profile information')
    </h1>
    <hr>
    <form class="mb-3" method="POST" enctype="multipart/form-data">
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
                @php($profilePicture = optional($user)->getFirstMedia('profile_pictures'))
                {{ inputFile()->name('profile_picture')
                    ->value(optional($profilePicture)->file_name)
                    ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $profilePicture]))
                    ->caption((new \App\Models\Users\User)->getMediaCaption('profile_pictures')) }}
                {{ inputText()->name('last_name')->model($user)->containerHtmlAttributes(['required']) }}
                {{ inputText()->name('first_name')->model($user)->containerHtmlAttributes(['required']) }}
                <h3>@lang('Contact')</h3>
                {{ inputEmail()->name('email')->model($user)->containerHtmlAttributes(['required']) }}
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('users.index')->containerClasses(['mr-2']) }}
                    @if($user){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
