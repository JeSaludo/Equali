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
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


</head>

<body>
    <div class="min-h-screen  bg-[#F7F7F7]">


        @include('layout.sidenav', ['active' => 0])
        <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

            <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Edit Exam </h1>

            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
            </div>

        </nav>


        <section class="ml-[218px] main ] ">

           
        <div class="mt-4 ">  
            <form action="{{ Route('admin.dashboard.update-exam', $exam->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="border border-[#D9DBE3] shadow-md  bg-white mx-4 rounded-lg flex relative p-2 drop-shadow-sm">

                    <div class="flex gap-2 p-2 w-full">
                        <div class=" ">
                            <img class=" w-[180px] h-[180px] rounded-md" src="{{ asset('img/equali-banner.png') }}"
                                alt="" srcset="">

                        </div>

                        <div class="w-9/12 mx-2 font-poppins ">

                            <input type="text" name="examName" value="{{ $exam->title }}"
                                class="block text-[36px] s font-bold text-[#26386A]">

                            <div class="flex justify-between w-8/12">
                                <div class="flex ">
                                    <p class="text-[18px]">Number of Question: </p>
                                    <input type="number" name="numOfQuestion" value="{{ $exam->num_of_question }}"
                                        class="w-5/12 ml-2 text-[18px]">

                                </div>
                                
                            </div>

                            <div class="mt-2 w-9/12">
                                <textarea name="description" class="w-full h-[80px] resize-none  text-[18px] text-[#827F8A]">{{ $exam->description }}</textarea>

                            </div>
                            
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


    <div class="mx-4 mt-4 bg-white flex justify-between gap-4 p-2 border border-[#D9DBE3] shadow-md rounded-lg">

        <form action="{{ route('admin.dashboard.store-random', $exam->id) }}" method="post" class="w-full gap-2 flex">
            @csrf

            <input type="number" name="numOfQuestions" value="5" class="w-2/12 text-[24px] font-poppins text-center mx-auto  border rounded-lg border-gray-300 ">
            <input type="submit" value="Add Random Question"
                class="text-lg font-poppins font-normal  w-full h-[50px] rounded-[8px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">
        </form>

       <div class="w-full">
        <form action="{{ route('admin.dashboard.exam.show-question', $exam->id) }}" method="post" class="w-full gap-2 flex">
            @csrf
                <button  class="drop-shadow-md border border-black px-2 py-1 h-[50px]  text-lg font-poppins font-normal w-full   rounded-[8px]  bg-[#F2F2F3] transition-colors duration-200 text-black" value="Add Question">
                    Add Question
                </button>            
        </form>
        </div>


        
    </div>

    <h1 class="mx-4  my-4 font-medium">{{ $examQuestions->count() }} Questions</h1>

    @if($examQuestions->count() === 0)
        <div class="mx-auto text-center"><h1>There is no question in the exam</h1></div>

    @else
        @foreach ($examQuestions as $examQuestion)
            <div class="bg-white mx-4 mt-4 p-4 border   border-[#D9DBE3] rounded-md shadow-md">

                <div class="w-full">
                    <h1 class="pb-2">{{ $examQuestion->question->question_text }}</h1>
                </div>

                <div class="w-full flex py-2">
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

            </div>
        @endforeach
    @endif
    </section>

    </div>

    <script src="{{ asset('js/exam.js') }}"></script>
</body>

</html>
