<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Full calendar -->
    <link href="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/demo-to-codepen.css') }}" rel="stylesheet">

    <link href="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min(1).css') }}" rel="stylesheet">
    <link href="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min(2).css') }}" rel="stylesheet">


    <script src="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/demo-to-codepen.js.download') }}"></script>
    <script src="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min.js.download') }}"></script>
    <script src="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min.js(1).download') }}"></script>
    <script src="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min.js(2).download') }}"></script>
    <script src="{{ asset('Timeline view with custom columns - Demos _ FullCalendar_files/main.min.js(3).download') }}"></script>

    <!-- <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/packages/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/packages/list/main.css') }}" rel='stylesheet' /> -->

    <!-- <link href="{{ asset('fullcalendar/timeline/main.min.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/resource-timeline/main.min.css') }}" rel='stylesheet' /> -->
</head>
<body>
    <?php
        $tenantInfo = tenancy()->getTenant();
    ?>

    @include('layouts.navbar')

    <main class="container container-auth">
        @yield('content')
    </main>
    @yield('javascript')

    <script>
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "progressBar": true,
            "hideDuration": "200",
        }
        @if(Session::has('alerts'))
            let alerts = {!! json_encode(Session::get('alerts')) !!};
            helpers.displayAlerts(alerts, toastr);
        @endif

        @if(Session::has('message'))
            var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
            var alertMessage = {!! json_encode(Session::get('message')) !!};
            var alerter = toastr[alertType];

            if (alerter) {
                alerter(alertMessage);
            } else {
                toastr.error("toastr alert-type " + alertType + " is unknown");
            }
        @endif
        // rotate 90 of down-arrow
        $(document).ready(function(){
            $('.js-change-caret').click(function(){
                $('.js-change-caret i').toggleClass('fa-caret-down')
                $('.js-change-caret i').toggleClass('fa-caret-right')
            });
        });
    </script>

    <!-- <script src="{{ asset('fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/packages/list/main.js') }}"></script> -->

    <!-- <script src="{{ asset('fullcalendar/timeline/main.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/resource-common/main.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/resource-timeline/main.min.js') }}"></script> -->
</body>
</html>
