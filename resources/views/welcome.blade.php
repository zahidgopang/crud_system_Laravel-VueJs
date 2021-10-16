<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crud System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="antialiased">
    <div class="container">

        <div class="row">

            <a href="{{ URL('ExportCSV') }}">
            <div class="d-grid" style="padding: 18px;">
                <button class="btn btn-secondary"
                >
                    {{ "Export CSV" }}

                </button>
            </div></a>


            <div class="col-md-12" id="app">

                <Directory/>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
