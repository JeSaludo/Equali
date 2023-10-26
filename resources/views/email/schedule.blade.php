<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Landing Page </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <h1>Schedule Information</h1>

    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($get_date)->format('F j, Y') }}</p>
    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($get_start_time)->format('h:i A') }}</p>
    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($get_end_time)->format('h:i A') }}</p>


</body>


</html>
