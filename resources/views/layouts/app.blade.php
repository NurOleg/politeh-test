<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TEST</title>

    <!-- Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,600"
            rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link
            rel="stylesheet"
            href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
            crossorigin="anonymous">

    <!-- Optional theme -->
    <link
            rel="stylesheet"
            href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
            integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
            crossorigin="anonymous">

    <script
            src="//code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script
            src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>

<div id="app">
    <div class="container">
        <div class="row">
            <a href="{{ route('employee.index') }}" class="btn btn-primary">Работники</a>
            <a href="{{ route('department.index') }}" class="btn btn-primary">Отделы</a>
            <a href="{{ route('department.create') }}" class="btn btn-primary">Создать отдел</a>
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
