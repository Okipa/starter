<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="{{ csrf_token() }}" name="csrf-token"/>
    <link rel="shortcut icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect dns-prefetch" href="https://fonts.googleapis.com" crossorigin> {{-- Todo: to remove if no Google font import is made. --}}
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet"/>
    @isset($css)<link href="{{ $css }}" rel="stylesheet"/>@endisset
    @livewireStyles
    @brickablesCss
    @if(app()->environment() !== 'production'){!! SEO::generate() !!}@else{!! SEO::generate(true) !!}@endif
</head>
