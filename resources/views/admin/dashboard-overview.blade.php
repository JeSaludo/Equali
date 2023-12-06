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


            <div class="my-2 flex items-center">
                

                <div class="my-2">
                     {{-- <i class='bx bx-cog bx-sm text-[#8B8585]'></i> --}}
                    <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                    <i id="openPopup" class='hover:cursor-pointer bx bxs-user-circle bx-sm text-[#617388] hover:text-blue-600 focus:z-10 focus:ring-2 focus:ring-blue-600 focus:text-blue-600'></i>
               
               
                </div>
            </div>

            <script>
                document.getElementById('openPopup').addEventListener('click', () => {
                    const popupContent = document.getElementById('popupContent');
                    if (popupContent.classList.contains('hidden')) {
                        popupContent.classList.remove('hidden');
                    } else {
                        popupContent.classList.add('hidden');
                    }
                });
            </script>
            
          

        </nav>

       


        <section class="ml-[218px] main ">

            <div id="popupContent" class="absolute z-50 right-2 font-poppins top-12 hidden">
                <div class="w-60 text-[#617388] bg-white border border-gray-200 rounded-lg shadow-md ">
                    <a href="{{route('admin.show-profile')}}" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-600 focus:z-10 focus:ring-2 focus:ring-blue-600 focus:text-blue-600 ">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                        Profile
                    </a>
                    <a href="{{route('admin.show-setting')}}" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 hover:bg-gray-100 hover:text-blue-600 focus:z-10 focus:ring-2 focus:ring-blue-600 focus:text-blue-600 ">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                        </svg>
                        Settings
                    </a>
                  
                    <a href="{{route('auth.logout')}}" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium rounded-b-lg hover:bg-gray-100 hover:text-blue-600 focus:z-10 focus:ring-2 focus:ring-blue-600 focus:text-blue-600 ">
                        <i class='bx bx-log-out pr-2' ></i>
                        Logout
                    </a>
                </div>
            </div>

            <div class="flex-row md:flex justify-evenly my-4 ">

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


                    <div class="flex items-end gap-3 text-[#718297] mb-8">
                        <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $user->count() }}</p>
                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Approve Applicants</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297] ">
                        <i class='bx bxs-user-check text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $user->where('status', 'Ready For Interview')->count() + $user->where('status', 'WaitListed')->count() }} </p>
                    </div>
                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>


                </div>



                <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Applicants</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297] ">

                        <i class='bx bxs-time text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $user->where('status', 'Pending')->count() }} </p>
                    </div>
                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>


                </div>

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Qualified Applicants</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297]">
                        <i class='bx bx-check-double text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $user->where('status', 'Qualified')->count() }}</p>


                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>
            </div>
            <div
                class="my-4 text-left rtl:text-right bg-white mx-4 h-[385px]  border   border-[#D9DBE3]  shadow-md rounded-lg">
                <div class="overflow-x-auto ">
                    <table
                        class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                        <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold  whitespace-nowrap">
                            <tr>
                                <td class="px-6 py-2">ID</td>
                                <td class="px-6 py-2">Applicant Name</td>
                                <td class="px-6 py-2">Date Created</td>
                                <td class="px-6 py-2">Status</td>

                            </tr>
                        </thead>

                        <tbody class="text-md">
                            @if ($recentApplicants->count() == 0)
                                <tr>
                                    <td></td>
                                    <td class="">

                                        <p class="my-3">No Data found in the database</p>

                                    </td>
                                    <td></td>
                                </tr>
                            @else

                                @foreach ($recentApplicants as $index => $recentApplicant)
                                    <tr
                                        class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }}  border-b   border-gray-100 text-left ">

                                        <td class="px-6 py-3 text-sm">{{ $recentApplicant->id }}</td>
                                        <td class="px-6 py-3">
                                            <p class="font-medium font-poppins text-[#617388]">
                                                {{ $recentApplicant->last_name }}, {{ $recentApplicant->first_name }}</p>
                                            <p class="text-[12px] font-poppins text-[#8898AC]">
                                                {{ $recentApplicant->email }}
                                        </td>
                                        <td class="px-6 py-3">{{ $recentApplicant->created_at }}</td>
                                    <td class="px-6 py-3">
                                        @if($recentApplicant->status == "WaitListed")
                                            <span class="bg-sky-200  text-[14px] text-sky-700 py-1 px-2 rounded-md ">Waitlisted</span>
                                        @elseif($recentApplicant->status == "Qualified")
                                            <span class="bg-blue-200  text-[14px] text-blue-700 py-1 px-2 rounded-md ">Qualified</span>
                                        @elseif($recentApplicant->status == "Ready For Interview")
                                            <span class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Ready For Interview</span>
                                        @elseif($recentApplicant->status == "Ready For Exam")
                                            <span
                                                class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Ready For Exam</span>

                                        @elseif($recentApplicant->status == "Unqualified")
                                            <span class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Unqualified</span>
                                        @elseif($recentApplicant->status == "Archived")
                                            <span class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Archived</span>
                                        @elseif($recentApplicant->status == "Pending")
                                            <span class="bg-orange-200  text-[14px] text-orange-700 py-1 px-2 rounded-md ">Pending</span>
                                        @endif  
                                        
                                        
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>


                </div>

            </div>






        </section>

    </div>

</body>

</html>
