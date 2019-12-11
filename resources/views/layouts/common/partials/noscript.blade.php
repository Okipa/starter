<noscript class="d-flex justify-content-center bg-danger text-white p-4">
    @if($gtmId = $settings->google_tag_manager_id)
        <iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}"
                height="0"
                width="0"
                style="display:none;visibility:hidden;"></iframe>
    @endif
    <div class="noscript">
        <h3>
            <i class="fa fa-exclamation-triangle"></i>
            @lang('Beware')
        </h3>
        @lang('Javascript is currently disabled in your browser and you are currently browsing in a degraded version. Thank you for reactivating your Javascript to benefit from all the features offered by our web platform.')
    </div>
</noscript>
