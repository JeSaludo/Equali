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


        <section class="ml-[218px] main ">
            <div class="relative ">
                <div id="addExamContent"
                    class="absolute  w-6/12  z-10 top-10 right-0 mx-auto opacity-0 left-0   translate-y-[-15px] transition-all transform  delay-150 ease-linear">
                    <form action="{{ Route('admin.dashboard.store-exam') }}" method="POST">
                        @csrf
                        <div class="bg-white mx-4 rounded-lg  border-2  px-6 py-4 drop-shadow-sm">
                            <h1 class="font-poppins text-[24px] pt-2">Create Exam Now</h1>
                            <p class="font-poppins text-[14px]">Review exam settings and you're good to go</p>

                            <div class="flex justify-between">
                                <div class="w-full">
                                    <div class=" my-4">
                                        <input type="text" name="examName"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[16px] border-2 border-[#D7D8D0]"
                                            placeholder="Untitled Exam" autocomplete="off">

                                    </div>


                                    <div class="my-2">
                                        <textarea name="description"
                                            class="w-full h-[80px] placeholder:font-poppins placeholder:text-[#4E4E4E] resize-none p-2 text-[16px] text-[#4E4E4E] border-2 border-[#D7D8D0]"
                                            placeholder="Description Here"></textarea>

                                    </div>


                                    <button id="" type="submit"
                                        class="px-2 py-1 text-lg font-poppins font-normal w-[100px]  rounded-[8px]  bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">

                                        PUBLISH </button>

                                </div>

                                <div class="w-full flex items-center">
                                    <img src="{{ asset('img/equali-banner.png') }}"
                                        class="w-[200px] h-[200px] text-center mx-auto" alt="" srcset="">
                                </div>
                            </div>
                        </div>



                    </form>

                </div>

            </div>

            <div class="flex justify-between mx-4 items-center">
                <h1 class="font-poppins text-2xl px-2 py-2 text-[#26386A]  font-semibold">Qualifying Exam</h1>
                <button id="addExamBtn"
                    class="px-2 py-1 text-lg font-poppins font-normal w-[100px]  rounded-[8px]  bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">

                    CREATE </button>
            </div>
            <div id="examContent">

               
                
                @if($exams->count() == 0)
                <div class="bg-white mx-4 py-6 rounded-lg flex relative my-2 drop-shadow-sm ">
                    <h1 class="text-black mx-auto text-center">No exam found in database</h1>
                </div>
                  
                @else
                   
                        @foreach ($exams as $exam)
                        <div class="bg-white mx-4 rounded-lg flex relative my-2 drop-shadow-sm ">

                            <div class="flex gap-2 p-2 w-full">
                                <div class=" ">
                                    <img class=" w-[100px] h-[100px] rounded-md" src="{{ asset('img/equali-banner.png') }}">
                                </div>

                                <div class="w-9/12 mx-2 font-poppins">
                                    <h1 class="text-xl s font-bold text-[#26386A] ">{{ $exam->title }}</h1>
                                   
                                    <p class="text-[14px] text-[#827F8A]">{{ $exam->description }}</p>
                                </div>
                            </div>

                            <div class="relative">
                                <div class="px-3 py-3">
                                    <i class='bx bx-dots-vertical bx-sm text-[#827F8A]'></i>
                                </div>

                                <div class="absolute bottom-2 m-2 mr-5 right-0  flex justify-between">
                                    <div class="">
                                        <a href="{{ route('admin.dashboard.edit-exam', $exam->id) }}"
                                            class="drop-shadow-md border border-gray-200 bg-[#F2F2F3] hover:bg-[#d2d2d2] hover:text-[white] px-4 py-2 rounded-md">EDIT</a>

                                    </div>

                                    <form action="{{ route('admin.dashboard.delete-exam', $exam->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mx-2  hover:text-indigo-900"
                                            onclick="return confirm('Are you sure you want to delete this Exam?')"><i
                                                class='bx bxs-trash'></i></button>

                                    </form>
                                </div>


                            </div>


                        </div>
                    @endforeach
                @endif
            </div>

        </section>

    </div>

    <script src="{{ asset('js/exam.js') }}"></script>


</body>

</html>
