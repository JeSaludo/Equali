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
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>

        <h1 class="font-bold">Exam Result for : {{ $last_name . ',' . $first_name }}</h1>
        <b></b>
        @foreach ($tempQuestion as $index => $question)
            <div class="mx-16">
                <p class="text-[#626B7F]">
                <div>
                    <h2>{{ $index + 1 }}. {{ $question['question_text'] }}</h2>
                </div>
                </p>
                <div>
                    @foreach ($question['choices'] as $choice)
                        <div class="border-t-2 border-x-2 rounded-t-lg flex w-6/12 items-center">
                            <p class="ml-2 py-1">
                                {{ $choice['choice_text'] }}
                                @if ($choice['is_correct'])
                                    <span class="text-green-500">(Correct)</span>
                                @endif
                                @if ($choice['userChoice'] == $choice['choice_text'])
                                    <span class="text-blue-500">(Student Choice)</span>
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mx-0 border-b-2 my-4"></div>
        @endforeach



    </body>


</html>
