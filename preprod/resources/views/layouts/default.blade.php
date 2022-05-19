<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UpDaz | Développeur Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow" />
    <link rel="icon" type="image/png" href="{{ asset("img/favicon.png") }}" />
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    {{-- @include('elements.google-analytics') --}}
</head>
<body>
    @yield('content')
</body>

</html>
