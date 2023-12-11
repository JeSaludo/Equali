<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Landig Page </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        @vite('resources/css/app.css')
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    </head>

    <body>
        <div class="min-h-screen w-[1440px] mx-auto ">
            @include('layout.danger-alert')
            <nav class="h-[60px] flex justify-between mx-[40px]">

                <div class="w-[500px] flex justify-between items-center">
                    <div>
                        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.
                        </h1>
                    </div>

                </div>




                <div class=" flex justify-between items-center">
                    <div class="mr-[120px]">
                        <ul class="flex space-x-4 font-poppins font-normal  ">
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">Home</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">About</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">Resources</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">FAQs</li>
                        </ul>
                    </div>

                    @if (Auth::check())
                        <div class="flex gap-5">
                            <a href="" class="text-[#403838] text-[16px]">{{ Auth::user()->first_name }}</a>
                            <a href="{{ route('auth.logout') }}" id="logoutLink"
                                class="text-[#403838] text-[16px]">Logout</a>
                        </div>
                    @else
                        <a href="{{ route('auth.login') }}"
                            class=" bg-[#2B6BE6]  text-white mx-[4px] px-8 py-2 rounded-[18px] hover:bg-[#134197] ">Login</a>
                    @endif

                </div>
            </nav>

            <div class="flex flex-row  my-[70px]  w-full ">
                <div class="mx-auto w-6/12 pl-[80px]">

                    <h1 class="text-[48px] text-[#2F2E41]  font-open font-bold">Your Gateway to Success: Qualifying Exam
                        Platform</h1>
                    <p class="text-[20px] w-8/12 text-[#403838] font-open font-normal">Official Online Resource for
                        Taking
                        and Excelling in
                        Qualifying Exams</p>


                    <div class="my-8 w-10/12 flex justify-start  ">



                        @if (auth()->check())
                            <a href="{{ route('student.show-exam') }}"
                                class="flex items-center justify-center text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">Take
                                Exam</a>
                        @else
                            <a href="{{ route('auth.login') }}"
                                class="flex items-center justify-center text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">Take
                                Exam</a>
                        @endif
                        <a
                            class="flex items-center justify-center text-lg font-poppins font-normal ml-2 w-full h-[50px] rounded-[18px] bg-transparent hover:bg-[#cccccc] transition-colors duration-200 border-[#cccccc] border-2">Learn
                            More</a>
                    </div>
                </div>

                <div class="mx-auto w-5/12">
                    <img class="w-9/12 " src="{{ asset('img/online-test.png') }}" alt="">
                </div>
            </div>

        </div>
        <script src="{{ asset('js/exam.js') }}"></script>
        <script>
            document.getElementById('logoutLink').addEventListener('click', function() {
                localStorage.removeItem('examChoices');
            });
        </script>


    </body>

</html>
