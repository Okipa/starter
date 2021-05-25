@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-laptop-code fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <p>
            {{ __('Please note that you are responsible for complying with the GDPR law on this platform.') }}<br>
            {{ __('For this purpose, you must configure all services using cookies and collecting data from your users on this interface.') }}
        </p>
        <p>
            {{ __('To help you during this configuration process, you can read the documentation of the used CMP tool:') }}
            <a href="https://heyklaro.com/docs" title="GDPR" target="_blank" rel="noopener">https://heyklaro.com/docs</a>.<br>
            {{ __('You will also find all the necessary information about GDPR law on this resource:') }}
            <a href="https://gdpr.eu" title="GDPR" target="_blank" rel="noopener">https://gdpr.eu</a>.
        </p>
        <form class="d-flex justify-content-end m-0"
              action="{{ route('cookie.services.index') }}"
              novalidate>
            @foreach($request->except('category_id') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            {{ select()->name('category_id')
                ->prepend('<i class="fas fa-tags fa-fw"></i>')
                ->label(false)
                ->disablePlaceholder()
                ->options(App\Models\Cookies\CookieCategory::get()
                    ->map(fn(App\Models\Cookies\CookieCategory $cookieCategory) => [
                        'id' => $cookieCategory->id,
                        'name' => $cookieCategory->title
                    ])
                    ->sortBy('title'), 'id', 'name')
                ->selectOptions('id', (int) $request->category_id)
                ->containerClasses([]) }}
            {{ submitValidate()->prepend('<i class="fas fa-filter"></i>')
                ->label(__('Filter'))
                ->containerClasses(['ms-3']) }}
            @if($request->has('category_id'))
                {{ buttonBack()->route('cookie.services.index')
                    ->prepend('<i class="fas fa-undo"></i>')
                    ->label(__('Reset'))
                    ->containerClasses(['ms-3']) }}
            @endif
        </form>
        {{ $table }}
    </x-admin.forms.card>
@endsection
