<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-language" content="{{ implode(',', supportedLocaleKeys()) }}">
    <link rel="shortcut icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('/favicon.ico') }}" type="image/x-icon">
    <meta content="{{ csrf_token() }}" name="csrf-token"/>
    @if(app()->environment() !== 'production'){!! SEO::generate() !!}@else{!! SEO::generate(true) !!}@endif
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet"/>
    @if(! empty($css))<link href="{{ $css }}" rel="stylesheet"/>@endif
    @brickablesCss
    @shared
</head>
