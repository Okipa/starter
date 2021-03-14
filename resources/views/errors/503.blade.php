@extends('layouts.front.empty')
@section('template')
    <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    @include('components.common.multilingual.lang-switcher', [
                        'containerClasses' => ['text-end'],
                        'dropdownLabelClasses' => ['btn', 'btn-link'],
                        'dropdownMenuClasses' => ['dropdown-menu-end']
                    ])
                    @if($icon = settings()->getFirstMedia('icons'))
                        {{ $icon('auth') }}
                    @endif
                </div>
                <h1 class="h3 font-weight-normal text-info mt-3">
                    <i class="fas fa-tools fa-fw"></i>
                    {{ __('Maintenance in progress') }}
                </h1>
                <p class="h5">
                    {{ __('Service currently unavailable.') }}
                </p>
                {{ buttonBack()->route('home.page.show')->label(__('Retry'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
