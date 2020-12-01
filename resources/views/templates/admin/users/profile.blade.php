@if (session('status') === 'two-factor-authentication-enabled')
    @php
        alert()->html(__('Success'), __('Two factor authentication has been enabled.'), 'success')->showConfirmButton()
    @endphp
@endif
@if (session('status') === 'two-factor-authentication-disabled')
    @php
        alert()->html(__('Success'), __('Two factor authentication has been disabled.'), 'success')->showConfirmButton()
    @endphp
@endif
@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        @lang('Profile')
    </h1>
    <hr>
    {{ buttonBack()->route('users.index') }}
    <p>
        @include('components.common.form.notice')
    </p>
    <div class="card-columns">
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">@lang('Profile Information')</h2>
            </div>
            <div class="card-body">
                <p>
                    @lang('Update your account\'s profile and contact information.')
                </p>
                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data"
                      novalidate>
                    @csrf
                    @method('PUT')
                    @php($profilePicture = optional($user)->getFirstMedia('profile_pictures'))
{{--                    {{ inputFile()->name('profile_picture')--}}
{{--                        ->value(optional($profilePicture)->file_name)--}}
{{--                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $profilePicture]))--}}
{{--                        ->caption((new \App\Models\Users\User)->getMediaCaption('profile_pictures')) }}--}}
{{--                    {{ inputText()->name('last_name')--}}
{{--                        ->model($user)--}}
{{--                        ->componentHtmlAttributes(['required', 'autocomplete' => 'family-name']) }}--}}
{{--                    {{ inputText()->name('first_name')--}}
{{--                        ->model($user)--}}
{{--                        ->componentHtmlAttributes(['required', 'autocomplete' => 'given-name']) }}--}}
{{--                    {{ inputTel()->name('phone_number')--}}
{{--                        ->model($user)--}}
{{--                        ->componentHtmlAttributes(['autocomplete' => 'tel']) }}--}}
                    {{ inputEmail()->name('email')
                        ->model($user)
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'email']) }}
                    @if($user){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </form>
            </div>
        </div>
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">@lang('Update Password')</h2>
                </div>
                <div class="card-body">
                    <p>
                        @lang('Ensure your account is using a long, random password to stay secure.')
                    </p>
                    <form method="POST"
                          action="{{ route('password.update') }}"
                          novalidate>
                        @csrf
                        @method('PUT')
                        {{ inputPassword()->name('current_password')
                            ->componentHtmlAttributes(['required', 'autocomplete' => 'current-password']) }}
                        {{ inputPassword()->name('new_password')
                            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
                        {{ inputPassword()->name('new_password_confirmation')
                            ->componentHtmlAttributes(['required', 'autocomplete' => 'new-password']) }}
                        {{ submitUpdate() }}
                    </form>
                </div>
            </div>
        @endif
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">@lang('Two Factor Authentication')</h2>
                </div>
                <div class="card-body">
                    @if($user->two_factor_secret)
                        <h5 class="card-title">
                            @lang('You have enabled two factor authentication.')
                        </h5>
                    @else
                        <h5 class="card-title">
                            @lang('You have not enabled two factor authentication.')
                        </h5>
                    @endif
                    <p>
                        @lang('Add additional security to your account using two factor authentication.')
                    </p>
                    <p>
                        @lang('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.')
                    </p>
                    @if($user->two_factor_secret)
                        <div class="my-3">
                            <p>
                                @lang('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.')
                            </p>
                            <div>
                                {!! $user->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                        <div class="my-3">
                            <p>
                                @lang('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.')
                            </p>
                            <pre class="bg-light p-3 small">@foreach ($user->recoveryCodes() as $code)<div>{{ $code }}</div>@endforeach</pre>
                        </div>
                        <div class="d-flex mt-3">
                            <form method="POST"
                                  action="{{ route('two-factor.recovery.regen') }}"
                                  novalidate>
                                @csrf
                                {{ submit()->prepend('<i class="fas fa-redo fa-fw"></i>')
                                    ->label(__('Regenerate Recovery Codes'))
                                    ->componentClasses(['btn-secondary'])
                                    ->componentHtmlAttributes(['data-confirm' => __('Are you sure you want to regenerate recovery codes?')]) }}
                            </form>
                            <form class="ml-3"
                                  method="POST"
                                  action="{{ route('two-factor.deactivate') }}"
                                  novalidate>
                                @csrf
                                @method('DELETE')
                                {{ submit()->prepend('<i class="fas fa-ban fa-fw"></i>')
                                    ->label(__('Disable'))
                                    ->componentClasses(['btn-danger'])
                                    ->componentHtmlAttributes(['data-confirm' => __('Are you sure you want to disable two factor authentication?')]) }}
                            </form>
                        </div>
                    @else
                        <form method="POST"
                              action="{{ route('two-factor.activate') }}"
                              novalidate>
                            @csrf
                            {{ submit()->prepend('<i class="fas fa-check fa-fw"></i>')
                                ->label(__('Enable'))
                                ->componentClasses(['btn-success'])
                                ->componentHtmlAttributes(['data-confirm' => __('Are you sure you want to enable two factor authentication?')]) }}
                        </form>
                    @endif
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">@lang('Delete Account')</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">
                    <i class="fas fa-exclamation-triangle fa-fw text-danger"></i>
                    @lang('Beware, this action is irreversible.')
                </h5>
                <p>
                    @lang('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')
                </p>
                <form method="POST"
                      action="{{ route('profile.deleteAccount') }}"
                      novalidate>
                    @csrf
                    {{ inputPassword()->name('password')
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'current-password']) }}
                    {{ submit()->prepend('<i class="fas fa-trash fa-fw"></i>')
                        ->label(__('Delete Account'))
                        ->componentClasses(['btn-danger'])
                        ->componentHtmlAttributes(['data-confirm' => __('Are you sure you want to delete your account?')]) }}
                </form>
            </div>
        </div>
    </div>
@endsection
