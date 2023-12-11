<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | AddQuestion </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        @vite('resources/css/app.css')
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')



                <div class="bg-white mx-4 rounded-[12px] h-[587px] p-4">

                    <div class="bg-[#4c4a67] h-[250px] rounded-[8px] flex justify-between p-4">

                        @if ($question->image_path == null)
                            <div class="w-full m-4 mt-12 flex items-center">
                                <input
                                    class="bg-transparent text-[28px] mx-auto text-center flex items-center py-8 w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                    placeholder="Type Question Here" name="question_text" required autocomplete="off"
                                    value="{{ $question->question_text }}" readonly>
                            </div>
                        @endif
                    </div>

                    <div>
                        <div class="h-[163px] my-7 flex justify-evenly gap-4">
                            @foreach ($question->choices->where('choice_text', '!=', 'No Answer') as $key => $choice)
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px] placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Question Here" name="choice_text[]"
                                        value="{{ $choice->choice_text }}" required readonly>

                                    <input
                                        class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 "
                                        type="radio" id="choice" name="correct_choice" value="{{ $key + 1 }}"
                                        @if ($choice->is_correct) checked @endif disabled>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end w-full">
                            <div class="w-/12 mb-8">
                                <a href="{{ route('admin.dashboard.view-question') }}"
                                    class="px-8 py-2 text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">Back</a>
                            </div>
                        </div>
                    </div>



                </div>

            </section>

        </div>

    </body>

</html>
