<!-- Global site tag (gtag.js) - Google Analytics -->
@env('production')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('custom.g-analytics.id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ config('custom.g-analytics.id') }}');
    </script>
@endenv
