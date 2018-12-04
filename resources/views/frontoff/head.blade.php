<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{!!  csrf_token()  !!}" />
    <meta name="url-app" content="{!! $app->make('url')->to('/') !!}" />

    <title>{{ config('app.name', 'Quizz Digital') }}</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Sortable -->
    <link href="{{ asset('/css/jquery-ui.min.css') }}?v={{ time() }}" rel="stylesheet">

    <!-- App -->
    <link href="{{ asset('/css/frontoff-app.css') }}?v={{ time() }}" rel="stylesheet">

    <!-- Template -->
    @if (Route::currentRouteName() != 'podium-quizz')
        <link href="{{ asset('/css/frontoff-app.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('/css/'.$template->stylesheet) }}?v=1" rel="stylesheet">
    @else
        <link href="{{ asset('/css/podium.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('/css/'.$template->podiumCss) }}?v=1" rel="stylesheet">
    @endif

</head>