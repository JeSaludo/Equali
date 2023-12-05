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
        <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">


           


            <div class="my-2 ">
                <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
            </div>

        </nav>


        <section class="ml-[218px] main ">
            

            

            <div class="flex  mx-4 mt-2 justify-between">

                
                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Exam</h1>    <button id="addExamBtn"
                    class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">

                    CREATE </button>
            </div>
            <div id="examContent" >

               
                
                @if($exams->count() == 0)
                <div class="bg-white mx-4 py-6  flex relative my-2 drop-shadow-sm border border-[#D9DBE3] shadow-md rounded-lg ">
                    <h1 class="text-black mx-auto text-center">No exam found in database</h1>
                </div>
                  
                @else
                   
                        @foreach ($exams as $exam)
                        <div class="bg-white mx-4 border border-[#D9DBE3] shadow-md rounded-lg flex relative my-2 drop-shadow-sm ">

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
            <div id="addExamContent" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                <div class="w-6/12 mx-auto">
                    <form action="{{ Route('admin.dashboard.store-exam') }}" method="POST">
                        @csrf
                        <div  class="relative bg-white mx-auto text-center rounded-[12px] w-[520px] h-[380px] p-4 border   border-[#D9DBE3]  ">
                         
                            <h1 class="font-poppins text-[24px] pt-2">Create Exam Now</h1>
                            <p class="font-poppins text-[14px]">Review exam settings and you're good to go</p>
                            <a id="closePopup" class="absolute hover:cursor-pointer top-0 right-0 p-2" ><i
                                class='bx bx-x bx-sm text-[#26386A]'></i></a>
                           
                                <div class="flex justify-between p-1 my-4 items-center mx-2">
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
                                        class="px-2 py-1 text-lg font-poppins font-normal w-full  rounded-[8px]  bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">

                                        PUBLISH </button>

                                </div>

                                <div class="w-full flex items-center">
                                    <img src="{{ asset('img/equali-banner.png') }}"
                                        class="w-[180px] h-[180px] text-center mx-auto" alt="" srcset="">
                                </div>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </section>

    </div>

    
    <script>
        document.getElementById("addExamBtn").addEventListener("click", () => {
        document.getElementById("addExamContent").classList.remove("hidden");
    });
    
    document.getElementById("closePopup").addEventListener("click", () => {
        document.getElementById("addExamContent").classList.toggle("hidden");
    });
    
    </script>

</body>

</html>
