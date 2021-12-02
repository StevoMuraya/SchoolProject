<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="#" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('./images/logo_jpg.jpg') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('./css/media-queries.css') }}" />
    <link rel="stylesheet" href="{{ asset('./css/all.css') }}" />
    <title>Kenyatta Uni Check In System</title>
</head>

<body>
    <div class="dash-container">
        @include('includes/side-bar')
        @include('includes/top-nav')
        <div class="dash-content" id="dash_content">
            @yield('content-holder')
        </div>
    </div>
    <script src="{{ asset('./js/main.js') }}"></script>
</body>

</html>