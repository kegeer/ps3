<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="/images/favicon.ico">

    <title>Microbiota Control system</title>

    @include('layouts.styles')
    @yield('css')
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token()
            ]) !!}
    </script>

</head>


    <body class="bg-transparent">

        @yield('content')


        @include('layouts.scripts')
        @yield('js')


        <!-- App js -->
        <script src="/js/jquery.core.js"></script>
        <script src="/js/jquery.app.js"></script>

    </body>
</html>
