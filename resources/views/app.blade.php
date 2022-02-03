<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Banistmo | Test</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="https://lh3.googleusercontent.com/kErt5b8W8IFpLUoDZq4vWK-7ngjMYdEhQqTon7G25huSsoWB_He5ySud0sOhWkdM6mc" />
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ mix('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper" id="app">
        @if (Auth::check())
            <App ruta="{{ route('basepath') }}"></App>
        @else
            <Login></Login>
        @endif
    </div>
    <!-- ./wrapper -->

    <script src="{{ mix('js/template.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
