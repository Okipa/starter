@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Media library'), 'entity' => __('Files')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <form class="d-flex justify-content-end m-0"
              action="{{ route('libraryMedia.files.index') }}"
              novalidate>
            @foreach($request->except('category_id') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            {{ select()->name('category_id')
                ->prepend('<i class="fas fa-tags fa-fw"></i>')
                ->label(false)
                ->disablePlaceholder()
                ->options(App\Models\LibraryMedia\LibraryMediaCategory::get()
                    ->map(fn(App\Models\LibraryMedia\LibraryMediaCategory $libraryMediaCategory) => [
                        'id' => $libraryMediaCategory->id,
                        'title' => $libraryMediaCategory->title
                    ])
                    ->sortBy('title'), 'id', 'title')
                ->selectOptions('id', (int) $request->category_id)
                ->componentHtmlAttributes(['data-selector'])
                ->containerClasses([]) }}
            {{ submitValidate()->prepend('<i class="fas fa-filter"></i>')
                ->label(__('Filter'))
                ->containerClasses(['ml-3']) }}
            @if($request->has('category_id'))
                {{ buttonCancel()->route('libraryMedia.files.index')
                    ->prepend('<i class="fas fa-undo"></i>')
                    ->label(__('Reset'))
                    ->containerClasses(['ml-3']) }}
            @endif
        </form>
        {{ $table }}
    </x-admin.forms.card>
@endsection
