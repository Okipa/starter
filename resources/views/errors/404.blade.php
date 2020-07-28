@extends('layouts.front.empty')
@section('template')
    <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    @include('components.common.multilingual.lang-switcher', [
                        'containerClasses' => ['text-right'],
                        'dropdownLabelClasses' => ['btn', 'btn-link'],
                        'dropdownMenuClasses' => ['dropdown-menu-right']
                    ])
                    @if($icon = settings()->getFirstMedia('icons'))
                        {{ $icon('auth') }}
                    @endif
                </div>
                <h1 class="h3 font-weight-normal text-warning mt-3">
                    <i class="fas fa-search fa-fw"></i>
                    @lang('Page not found')
                </h1>
                {{ buttonBack()->route('home.page.show')->label(__('Back to home page'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
