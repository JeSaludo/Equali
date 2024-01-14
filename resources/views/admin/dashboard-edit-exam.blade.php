<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Overview </title>
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
                'route' => null,
                'show' => false,
            ])

            <section class="sm:ml-64 main">

                @include('layout.popup')


                <div class="mt-4 ">
                    <form action="{{ Route('admin.dashboard.update-exam', $exam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div
                            class="border border-[#D9DBE3] shadow-md  bg-white mx-4 rounded-lg flex relative p-2 drop-shadow-sm">

                            <div class="flex gap-2 p-2 w-full">
                                <div class=" ">
                                    <img class=" w-[180px] h-[180px] rounded-md"
                                        src="{{ asset('img/equali-banner.png') }}" alt="" srcset="">

                                </div>

                                <div class="w-9/12 mx-2 font-poppins ">

                                    <input type="text" name="examName" value="{{ $exam->title }}"
                                        class="block text-[36px] s font-bold text-[#26386A]">





                                </div>
                    </form>
                </div>

                <div>



                    <div class="absolute bottom-0 right-0 px-2 py-2   w-[130px]">

                        <button id="" type="submit"
                            class="drop-shadow-md border border-gray-200 px-2 py-1 text-lg font-poppins font-normal mr-2 w-full   rounded-[8px]  bg-[#F2F2F3] hover:bg-[#d2d2d2] hover:text-[white] transition-colors duration-200 text-[#676869]">

                            Save</button>
                    </div>
                </div>
                </form>
        </div>


        <div class="my-4 mx-4 w-[240px]">

            <form action="{{ route('admin.dashboard.store-random', $exam->id) }}" method="post"
                class="w-full gap-2 flex">
                @csrf
                <input type="submit" value="Add Random Question"
                    class="font-poppins text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
            </form>
        </div>

        <h1 class="mx-4  my-4 font-medium">{{ $examQuestions->count() }} /
            {{ $option->qualifying_number_of_items }} Questions </h1>

        @if ($examQuestions->count() === 0)
            <div class="mx-auto text-center">
                <h1>There is no question in the exam</h1>
            </div>
        @else
            @foreach ($examQuestions as $examQuestion)
                <div class="bg-white mx-4 mt-4 p-4 border   border-[#D9DBE3] rounded-md shadow-md relative">

                    <div class="w-full">
                        <h1 class="pb-2">{{ $examQuestion->question->question_text }}</h1>
                    </div>

                    <div class="w-full  flex py-2">
                        <div class="w-1/2">
                            <i
                                class='bx bxs-circle pr-2
                        @if ($examQuestion->question->choices->get(0)->is_correct) text-green-600 @else text-red-600 @endif '></i>

                            {{ $examQuestion->question->choices->get(0)->choice_text }}
                        </div>

                        <div>
                            <i
                                class='bx
                            bxs-circle pr-2 @if ($examQuestion->question->choices->get(1)->is_correct) text-green-600 @else text-red-600 @endif '></i>
                            {{ $examQuestion->question->choices->get(1)->choice_text }}
                        </div>


                    </div>


                    <div class="w-full flex py-2">
                        <div class="w-1/2">
                            <i
                                class='bx bxs-circle pr-2
                        @if ($examQuestion->question->choices->get(2)->is_correct) text-green-600 @else text-red-600 @endif '></i>
                            {{ $examQuestion->question->choices->get(2)->choice_text }}
                        </div>

                        <div>
                            <i
                                class='bx bxs-circle pr-2
                        @if ($examQuestion->question->choices->get(3)->is_correct) text-green-600 @else text-red-600 @endif '></i>
                            {{ $examQuestion->question->choices->get(3)->choice_text }}
                        </div>


                    </div>

                    <div class="bottom-0 right-0 absolute p-2">
                        <a href="{{ route('admin.dashboard.edit-question', $examQuestion->question->id) }}"
                            class="drop-shadow-md border border-gray-200 px-2 py-1 text-lg font-poppins font-normal mr-2 w-full   rounded-[8px]  bg-[#F2F2F3] hover:bg-[#d2d2d2] hover:text-[white] transition-colors duration-200 text-[#676869]">EDIT</a>
                    </div>

                </div>
            @endforeach
        @endif
        </section>

        </div>

        <script src="{{ asset('js/exam.js') }}"></script>
    </body>

</html>
