<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="title icon" type="image/png" href="images/logo.png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

</head>

@if (request()->path() === 'dashboard' || request()->path() === 'dashboard/Analytics')
    <body
        id="main-body"
        onload="
            lineChartData(
                '{{ $homeAnalytics['dailyLoggedInUsers'] }}',
                '{{ $homeAnalytics['weeklyLoggedInUsers'] }}',
                '{{ $homeAnalytics['monthlyLoggedInUsers'] }}'
            );
            barChartData(
                '{{ json_encode($homeAnalytics['weeklyAuthUsers']) }}',
                '{{ json_encode($homeAnalytics['weeklyNonAuthUsers']) }}'
            );
            activeUserExpandedChart(
                '{{ json_encode($homeAnalytics['weeklyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['monthlyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['threeMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['sixMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['yearlyActiveUsers']) }}'
            );
            authAndNonAuth();
            MobileVisitors();
            WebVisitors(
                '{{ json_encode($homeAnalytics['desktopBrowserVisitors']) }}',
                '{{ Json_encode($homeAnalytics['mobileBrowserVisitors']) }}',
            );
            authAndNonAuthChartBar(
                '{{ json_encode($homeAnalytics['weeklyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['monthlyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['threeMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['sixMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['yearlyActiveUsers']) }}'
            );
            activeUsersChart(
                '{{ json_encode($homeAnalytics['weeklyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['monthlyActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['threeMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['sixMonthsActiveUsers']) }}',
                '{{ Json_encode($homeAnalytics['yearlyActiveUsers']) }}'
            );
            stackedBarData(
                '{{ json_encode($homeAnalytics['newUsersRetention']) }}',
                '{{ json_encode($homeAnalytics['returningUsersRetention']) }}'
            );
            getUsersTimeSpent(
                '{{ $homeAnalytics['authUsersTimeSpent'] }}',
                '{{ $homeAnalytics['nonAuthUsersTimeSpent'] }}'
            );
        "
    >
@else
    <body id="main-body">
@endif
    <div class="bingo">
        <div id="main" class="container">
            @if(session()->get('notificationStatus') != null)
                @include('dashboard::assets.alerts')
            @endif

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('js/dashboard_analytics.js') }}"></script> --}}

    {{-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    @if (isset($viewUser) && $viewUser)
        <script type="text/javascript">
            $("#view-user-content,#view-user-background").toggleClass("active");
        </script>
    @endif

    @if (isset($newRoleFailed) && $newRoleFailed)
        <script type="text/javascript">
            $("#new-role-content,#new-role-background").toggleClass("active");
        </script>
    @endif

    @if (isset($updateRoleFailed) && $updateRoleFailed)
        <script type="text/javascript">
            $("#edit-role-content, #edit-role-background").toggleClass("active");
        </script>
    @endif

    @if (isset($editRole) && $editRole)
        <script type="text/javascript">
            $("#edit-role-content, #edit-role-background").toggleClass("active");
        </script>
    @endif

    @if (isset($viewRole) && $viewRole)
        <script type="text/javascript">
            $("#view-role-content,#view-role-background").toggleClass("active");
        </script>
    @endif

    @if (isset($newPermissionFailed) && $newPermissionFailed)
        <script type="text/javascript">
            $("#new-permission-content,#new-permission-background").toggleClass("active");
        </script>
    @endif

    @if (isset($updatePermissionFailed) && $updatePermissionFailed)
        <script type="text/javascript">
            $("#edit-permission-content, #edit-permission-background").toggleClass("active");
        </script>
    @endif

    @if(isset($editPermission) && $editPermission)
        <script type="text/javascript">
            $("#edit-permission-content, #edit-permission-background").toggleClass("active");
        </script>
    @endif

    @if (isset($viewPermission) && $viewPermission)
        <script type="text/javascript">
            $("#view-permission-content,#view-permission-background").toggleClass("active");
        </script>
    @endif

    @if (isset($newTosFailed) && $newTosFailed)
        <script type="text/javascript">
            $("#new-tos-content,#new-tos-background").toggleClass("active");
        </script>
    @endif


    @if (isset($updateTosFailed) && $updateTosFailed)
        <script type="text/javascript">
            $("#edit-tos-content, #edit-tos-background").toggleClass("active");
        </script>
    @endif

    @if (isset($editTos) && $editTos)
        <script type="text/javascript">
            $("#edit-tos-content, #edit-tos-background").toggleClass("active");
        </script>
    @endif

    @if (isset($viewTos) && $viewTos)
        <script type="text/javascript">
            $("#view-tos-content,#view-tos-background").toggleClass("active");
        </script>
    @endif
</body>
</html>
