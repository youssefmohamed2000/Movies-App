<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta name="description" content="">
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{--magnific-popup--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/js/plugins/magnific-popup/magnific-popup.css')}}">

</head>
<body class="app sidebar-mini">
<!-- Navbar-->
@include('layouts.admin.navbar')
<!-- Sidebar menu-->
@include('layouts.admin.sidebar')
<!-- Content -->
<main class="app-content">
    @yield('content')
</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('dashboard_files/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('dashboard_files/js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{asset('dashboard_files/js/plugins/chart.js')}}"></script>
{{--data-tables--}}
<script type="text/javascript"
        src="{{asset('dashboard_files/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('dashboard_files/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
<script src="{{asset('dashboard_files/js/plugins/magnific-popup/jquery.magnific-popup.js')}}"></script>



@yield('scripts')
<script type="text/javascript">
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86]
            }
        ]
    };
    var pdata = [
        {
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: 50,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
</body>
</html>
