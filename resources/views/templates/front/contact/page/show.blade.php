@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {!! $pageContent->displayBricks() !!}
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <form method="POST"
                      action="{{ route('contact.sendMessage') }}"
                      novalidate>
                    @honeypot
                    @csrf()
                    <div class="form-row">
                        <div class="col-md-6">
                            {{ inputText()->name('first_name')
                                ->label(false)
                                ->prepend('<i class="fas fa-user"></i>')
                                ->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'given-name']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputText()->name('last_name')
                                ->label(false)
                                ->prepend('<i class="fas fa-user"></i>')
                                ->componentHtmlAttributes(['required', 'autocomplete' => 'family-name']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputEmail()->name('email')
                                ->label(false)
                                ->componentHtmlAttributes(['required', 'autocomplete' => 'email']) }}
                        </div>
                        <div class="col-md-6">
                            {{ inputTel()->name('phone_number')
                                ->label(false)
                                ->componentHtmlAttributes(['autocomplete' => 'tel']) }}
                        </div>
                        <div class="col-md-12">
                            {{ textarea()->name('message')
                                ->label(false)
                                ->componentHtmlAttributes(['required', 'rows' => 5]) }}
                        </div>
                        <div class="col-md-8">
                            @include('components.common.form.notice')
                        </div>
                        <div class="col-md-4 text-right">
                            {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')->label(__('Send')) }}
                        </div>
                        @php
                            $termsOfServicePage = pages()->where('unique_key', 'terms_of_service_page')->first();
                            $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
                        @endphp
                        @if($termsOfServicePage && $gdprPage)
                            <div class="col-md-12 small mt-3">
                                @lang('By clicking on the "Send" button, I acknowledge that I have read the :terms_of_service_page_link, :gdpr_page_link pages and that this data will be used in the context of the commercial relationship that may result from it.', [
                                    'terms_of_service_page_link' => '<a href="' . route('page.show', $termsOfServicePage) . '" title="' . $termsOfServicePage->nav_title . '" data-new-window>' . $termsOfServicePage->nav_title . '</a>',
                                    'gdpr_page_link' => '<a href="' . route('page.show', $gdprPage) . '" title="' . $gdprPage->nav_title . '" data-new-window>' . $gdprPage->nav_title . '</a>',
                                ])
                            </div>
                        @endif
                        @php
                            $email = settings()->email;
                            $fullPostalAddress = settings()->full_postal_address;
                        @endphp
                        @if($email && $fullPostalAddress)
                            <div class="col-md-12 small mt-1">
                                @lang('Your personal data is subject to computer processing by :company, in order to answer your questions and/or complaints. You have a right of access, rectification, opposition, limitation and portability by contacting: :email or by mail to: :postal_address. You also have the right to lodge a complaint with the CNIL.', [
                                    'company' => config('app.name'),
                                    'email' => $email,
                                    'postal_address' => $fullPostalAddress
                                ])
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <hr class="d-lg-none">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h4 m-0">
                            <i class="far fa-address-book fa-fw"></i>
                            @lang('Contact us')
                        </h2>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 mb-3">
                            {{ config('app.name') }}
                        </h3>
                        @if($phoneNumber = settings()->phone_number)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-phone-alt fa-fw"></i></span>
                                {{ $phoneNumber }}
                            </p>
                        @endif
                        @if($email = settings()->email)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-at fa-fw"></i></span>
                                {{ $email }}
                            </p>
                        @endif
                        @if($fullPostalAddress = settings()->full_postal_address)
                            <p class="d-flex align-items-start">
                                <span class="mr-1"><i class="fas fa-compass fa-fw"></i></span>
                                {{ $fullPostalAddress }}
                            </p>
                        @endif
                    </div>
                    @if($fullPostalAddress = settings()->full_postal_address)
                        <div class="card-footer">
                            <a class="h5"
                               href="//maps.google.com/maps?q={{ str_replace([' ', ','], '+', $fullPostalAddress) }}"
                               data-lity>
                                <i class="fas fa-search-location fa-fw"></i>
                                @lang('See on the map')
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
