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



        <h1><strong> Interview Notification</strong></h1>

        <p>Dear {{ $get_last_name . ', ' . $get_first_name }}</p>

        <p>We hope this message finds you well. We would like to inform you that your application is
            currently under consideration, and we are pleased to invite you for an interview.</p>

        <p>Details of the interview are as follows:</p>

        <ul>
            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($get_date)->format('F j, Y') }}</li>
            <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($get_start_time)->format('h:i A') }}</li>
            <li><strong>Location:</strong> {{ $get_location }}</li>
        </ul>

        <p>Please confirm your availability for the scheduled interview. If you have any conflicts or questions,
            feel
            free to contact us.</p>

        <p>We look forward to discussing your qualifications and learning more about your experiences during the
            interview.</p>

        <p>Best regards,<br>
            Marinduque State College<br>
            (042) 332 2028</p>
    </body>


</html>
