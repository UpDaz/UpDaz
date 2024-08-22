<script defer>
    window.axeptioSettings = {
        clientId: "63fa545408385a13fb80fb00",
        cookiesVersion: "updaz-fr",
    };

    (function(d, s) {
        var t = d.getElementsByTagName(s)[0],
            e = d.createElement(s);
        e.async = true;
        e.src = "//static.axept.io/sdk.js";
        t.parentNode.insertBefore(e, t);
    })(document, "script");

    void 0 === window._axcb && (window._axcb = []);
    window._axcb.push(function(axeptio) {
        axeptio.on("cookies:complete", function(choices) {
            if (choices.google_analytics) {
                // loadGoogleAnalyticsTag()
            }
        });
    });
    window.addEventListener("load", function() {
        loadGoogleAnalyticsTag();
    });
</script>
