<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect dns-prefetch" href="https://fonts.googleapis.com" crossorigin> {{-- ToDo: to remove if no Google font import is made. --}}
    @include('feed::links')
    @if(app()->environment() !== 'production'){!! SEO::generate() !!}@else{!! SEO::generate(true) !!}@endif
    <link href="{{ mix('css/front.css') }}" rel="stylesheet"/>
    @isset($css)<link href="{{ $css }}" rel="stylesheet"/>@endisset
    @brickablesCss
</head>
