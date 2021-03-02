@if($gtmId = settings()->google_tag_manager_id)
    <link rel="preconnect dns-prefetch" href="https://www.googletagmanager.com" crossorigin>
    <link rel="preconnect dns-prefetch" href="https://www.google-analytics.com" crossorigin>
    <link rel="preconnect dns-prefetch" href="https://stats.g.doubleclick.net" crossorigin>
    <script type="text/plain" cookie-consent="tracking">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $gtmId }}');</script>
@endif
