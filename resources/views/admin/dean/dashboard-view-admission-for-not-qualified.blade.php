<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Admission </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    fontFamily: {
                        open: '"Open Sans"',
                        poppins: "'Poppins', sans-serif",
                        raleway: "'Raleway', sans-serif",
                    },
                    extend: {},
                }
            }
        </script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    </head>

    <body>





        <div class="min-h-screen  bg-[#F7F7F7]">

            @include('layout.danger-alert')

            @include('layouts.sidebar')


            @include('layouts.navigation', [
                'route' => 'dean.admission.unqualified',
                'show' => true,
            ])


            <section class="sm:ml-64 main">
                @include('layout.popup')

                @include('admin.dean.card')

                @include('admin.partials.admission-table', [
                    'title' => 'List of Unqualified Applicants',
                    'showAdmissionExam' => false,
                    'users' => $users,
                    'sortColumn' => $sortColumn,
                    'sortOrder' => $sortOrder,
                    'academicYears' => $academicYears,
                    'route' => 'dean.admission.unqualified',
                    'show' => true,
                ])



                @include('admin.program-head.add-applicant')







            </section>

        </div>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
