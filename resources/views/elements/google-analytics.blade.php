<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('custom.g-analytics.id') }}" defer></script>
<script>
  function loadGoogleAnalyticsTag() {
    console.log('test');
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ config('custom.g-analytics.id') }}');
  };
</script>
