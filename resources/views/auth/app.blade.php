<!DOCTYPE html>
<html lang="pt_BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', env('APP_NAME'))</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url(mix('css/vendor.min.css')) }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url(mix('css/bootstrap.min.css')) }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">
    @yield('content')
</div>

<script src="{{url(mix('js/vendor.min.js'))}}"></script>
{{--<script src="{{url(mix('js/Chart.min.js'))}}"></script>--}}
{{--<script src="{{url(mix('js/chart-area-demo.min.js'))}}"></script>--}}
{{--<script src="{{url(mix('js/chart-pie-demo.min.js'))}}"></script>--}}

</body>

</html>
