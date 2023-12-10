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
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4 ">


                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                @if (Auth::user()->role === 'ProgramHead')
                    <div class="flex-row md:flex justify-evenly my-4 ">

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8">
                                <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $user->where('role', 'Student')->count() }}</p>
                            </div>

                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Applicants</h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297] ">

                                <i class='bx bxs-time text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $user->where('status', 'Pending')->count() }} </p>
                            </div>
                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>


                        </div>

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Approve Applicants</h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297] ">
                                <i class='bx bxs-user-check text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">
                                    {{ $user->where('status', 'Pending Interview')->count() +
                                        $user->where('status', 'Pending Schedule')->count() +
                                        $user->where('status', 'Ready For Exam')->count() +
                                        $user->where('status', 'Pending Schedule')->count() }}

                                </p>
                            </div>
                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>


                        </div>



                    </div>
                @elseif(Auth::user()->role == 'Proctor')
                    <div class="flex-row md:flex justify-evenly my-4 ">

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Interview</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8">
                                <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">
                                    {{ $user->where('role', 'Student')->where('status', 'Pending Interview')->count() + $totalInterview->count() }}
                                </p>
                            </div>

                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>
                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Interview</h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297] ">
                                <i class='bx bxs-user-check text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">
                                    {{ $user->where('role', 'Student')->where('status', 'Pending Interview')->count() }}
                                </p>

                            </div>
                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>


                        </div>



                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Finished Interview</h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297]">
                                <i class='bx bxs-archive-in text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">
                                    {{ $totalInterview->count() }}
                                </p>


                            </div>

                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>
                    </div>
                @elseif(Auth::user()->role == 'Dean')
                    <div class="flex-row md:flex justify-evenly my-4 ">

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8">
                                <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $user->where('role', 'Student')->count() }}</p>
                            </div>

                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Qualified Applicants
                            </h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297] ">

                                <i class='bx bxs-time text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $user->where('status', 'Qualified')->count() }} </p>
                            </div>
                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>


                        </div>

                        <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Unqualified Applicants
                            </h1>


                            <div class="flex items-end gap-3 px-2 text-[#718297] ">
                                <i class='bx bxs-user-check text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">
                                    {{ $user->where('status', 'Unqualified')->count() }}

                                </p>
                            </div>
                            <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>


                        </div>



                    </div>
                @endif


                @include('layout.overview-table', ['users' => $recentUsers])







            </section>

        </div>

    </body>

</html>
