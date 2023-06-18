<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "LocalBusiness",
      "name": "UpDaz",
      "email": "matthieu@updaz.fr",
      "priceRange": "$",
      "address" : {
        "@type": "PostalAddress",
        "addressLocality": "Bordeaux",
        "addressRegion": "Nouvelle-Aquitaine",
        "postalCode": "33000",
        "addressCountry": "FR"
      },
      "funder": {
          "@type" : "Person",
          "name": "Matthieu Dazord"
      },
      "logo": "{{ asset('img/logo-blue.png') }}",
      "url" : "{{ route('home') }}",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
          ],
          "opens": "09:00",
          "closes": "18:00"
        }
      ]
    }
</script>
