@extends('layouts.front.full')
@section('template')
    <div class="mt-5 mb-4">
        {!! $pageContent->displayBricks() !!}
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-xl-8">
                <livewire:contact-form/>
                <div class="row">
                    @php
                        $termsOfServicePage = pages()->where('unique_key', 'terms_of_service_page')->first();
                        $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
                    @endphp
                    @if($termsOfServicePage && $gdprPage)
                        <div class="col-md-12 small mt-3">
                            {{ __('By clicking on the "Send" button, I acknowledge that I have read the :terms_of_service_page_link, :gdpr_page_link pages and that this data will be used in the context of the commercial relationship that may result from it.', [
                                'terms_of_service_page_link' => '<a href="' . route('page.show', $termsOfServicePage) . '" title="' . $termsOfServicePage->nav_title . '" data-new-window>' . $termsOfServicePage->nav_title . '</a>',
                                'gdpr_page_link' => '<a href="' . route('page.show', $gdprPage) . '" title="' . $gdprPage->nav_title . '" data-new-window>' . $gdprPage->nav_title . '</a>',
                            ]) }}
                        </div>
                    @endif
                    @php
                        $email = settings()->email;
                        $fullPostalAddress = settings()->full_postal_address;
                    @endphp
                    @if($email && $fullPostalAddress)
                        <div class="col-md-12 small mt-1">
                            {{ __('Your personal data is subject to computer processing by :company, in order to answer your questions and/or complaints. You have a right of access, rectification, opposition, limitation and portability by contacting: :email or by mail to: :postal_address. You also have the right to lodge a complaint with the CNIL.', [
                                'company' => config('app.name'),
                                'email' => $email,
                                'postal_address' => $fullPostalAddress
                            ]) }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-4">
                <hr class="d-xl-none my-5">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h4 m-0">
                            <i class="far fa-address-book fa-fw"></i>
                            {{ __('Contact us') }}
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
                               href="https://www.google.com/maps/embed/v1/place?key={{ config('services.google.key') }}&q={{ str_replace([' ', ','], '+', $fullPostalAddress) }}"
                               data-lightbox>
                                <i class="fas fa-search-location fa-fw"></i>
                                {{ __('See on the map') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
