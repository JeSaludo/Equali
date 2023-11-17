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
    <div class="min-h-screen  bg-[#EEF4F6]">


        @include('layout.sidenav')
        <div class="ml-[218px] w-auto  text-black flex justify-between ">
            <div class="mt-4">
                <h1 class="text-[#1D489A] font-poppins font-medium text-[24px] mx-8">Welcome, Name Here👋</h1>
                <p class="text-[#718297] text-[12px] font-raleway font-normal mx-8 mb-4">Check your info here</p>
            </div>
        
            <div class="mt-4">
                <form class="w-[400px]" method="get" action="">
                    @csrf
        
                   
                    <div class="relative w-full">
                    <input type="text" name="searchTerm" placeholder="Search Here" class="px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-gray-500 bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    <i class='bx bx-category-alt bx-sm text-gray-500 bx-sm absolute right-3 top-1/2 transform -translate-y-1/2'></i>
                    </div>
                </form>
            </div>
            
            <div class="mt-6">
                <h1>{{ now()->format('F j, Y') }}</h1>
              
            </div>
        
            <div class="mt-6 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M19 13.586V10C19 6.783 16.815 4.073 13.855 3.258C13.562 2.52 12.846 2 12 2C11.154 2 10.438 2.52 10.145 3.258C7.185 4.074 5 6.783 5 10V13.586L3.293 15.293C3.19996 15.3857 3.12617 15.4959 3.07589 15.6172C3.0256 15.7386 2.99981 15.8687 3 16V18C3 18.2652 3.10536 18.5196 3.29289 18.7071C3.48043 18.8946 3.73478 19 4 19H20C20.2652 19 20.5196 18.8946 20.7071 18.7071C20.8946 18.5196 21 18.2652 21 18V16C21.0002 15.8687 20.9744 15.7386 20.9241 15.6172C20.8738 15.4959 20.8 15.3857 20.707 15.293L19 13.586ZM19 17H5V16.414L6.707 14.707C6.80004 14.6143 6.87383 14.5041 6.92412 14.3828C6.9744 14.2614 7.00019 14.1313 7 14V10C7 7.243 9.243 5 12 5C14.757 5 17 7.243 17 10V14C17 14.266 17.105 14.52 17.293 14.707L19 16.414V17ZM12 22C12.6193 22.0008 13.2235 21.8086 13.7285 21.4502C14.2335 21.0917 14.6143 20.5849 14.818 20H9.182C9.38566 20.5849 9.76648 21.0917 10.2715 21.4502C10.7765 21.8086 11.3807 22.0008 12 22Z"
                        fill="#626B7F" />
                    <circle cx="18" cy="8" r="4" fill="#EA3332" />
                </svg>
            </div>
        </div>


        <section class="ml-[218px] main ] ">
            <form action="{{ Route('admin.dashboard.update-exam', $exam->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white mx-4 rounded-lg flex relative p-2 drop-shadow-sm">

                    <div class="flex gap-2 p-2 w-full">
                        <div class=" ">
                            <img class=" w-[100px] h-[100px] rounded-md" src="{{ asset('img/equali-banner.png') }}"
                                alt="" srcset="">

                        </div>




                        <div class="w-9/12 mx-2 font-poppins ">

                            <input type="text" name="examName" value="{{ $exam->title }}"
                                class="block text-xl s font-bold text-[#26386A]">

                            <div class="flex justify-between w-8/12">
                                <div class="flex ">
                                    <p class="text-[14px]">Number of Question: </p>
                                    <input type="number" name="numOfQuestion" value="{{ $exam->num_of_question }}"
                                        class="w-5/12 ml-2 text-[14px]">

                                </div>
                                {{-- <div class="flex ">
                                    <p class="text-[14px]">Passing Score: </p>
                                    <input type="number" name="passingScore" value="{{ $exam->passing_Score }}"
                                        class="w-5/12 ml-2 text-[14px]">

                                </div> --}}
                            </div>

                            <textarea name="description" class="w-full h-[80px] resize-none p-2 text-[14px] text-[#827F8A]">{{ $exam->description }}</textarea>

                        </div>
            </form>
        </div>

        <div>

            <div class="px-3 py-3">
                <i class='bx bx-dots-vertical bx-sm text-[#827F8A]'></i>
            </div>

            <div class="absolute bottom-0 right-0 px-2 py-2   w-[130px]">

                <button id="" type="submit"
                    class="drop-shadow-md border border-gray-200 px-2 py-1 text-lg font-poppins font-normal mr-2 w-full   rounded-[8px]  bg-[#F2F2F3] hover:bg-[#d2d2d2] hover:text-[white] transition-colors duration-200 text-[#676869]">

                    Save</button>
            </div>
        </div>
    </form>
    </div>


    <div class="mx-4 mt-4 bg-white flex justify-between gap-4 p-2">

        <form action="{{ route('admin.dashboard.store-random', $exam->id) }}" method="post" class="w-full">
            @csrf
            <input type="submit" value="Add Random Question"
                class="text-lg font-poppins font-normal  w-full h-[50px] rounded-[8px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">
        </form>

       <div class="w-full">
            <button  class="drop-shadow-md border border-black px-2 py-1 h-[50px]  text-lg font-poppins font-normal w-full   rounded-[8px]  bg-[#F2F2F3] transition-colors duration-200 text-black" value="Add Question">
                Add Question
            </button>
           

        </div>


        
    </div>

    <h1 class="mx-4  my-4">{{ $examQuestions->count() }} Questions</h1>

    @if($examQuestions->count() === 0)
        <div class="mx-auto text-center"><h1>There is no question in the exam</h1></div>

    @else
        @foreach ($examQuestions as $examQuestion)
            <div class="bg-white mx-4 mt-4 p-4">

                <div class="w-full">
                    <h1 class="pb-2">{{ $examQuestion->question->question_text }}</h1>
                </div>

                <div class="w-1/2 flex py-2">
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


                <div class="w-1/2 flex py-2">
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
