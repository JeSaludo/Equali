<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Applicant </title>
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
        <div class="min-h-screen  bg-[#EEF4F6]">


            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <div class="flex items-center  ">
                    <form method="get" action="{{ route('admin.dashboard.report.qualifying-exam') }}"
                        class="relative w-[300px]">
                        @csrf
                        <input type="text" name="searchTerm" placeholder="Search Here"
                            value="{{ request('searchTerm') }}"
                            class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                        <i
                            class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    </form>
                </div>


                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="flex-row md:flex justify-evenly my-4 ">

                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Interview</h1>


                        <div class="flex items-end gap-3 text-[#718297] mb-8">
                            <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                            <p class="text-[36px] py-0">
                                {{ $userCount->where('role', 'Student')->where('status', 'Pending Interview')->count() + $totalInterview->count() }}
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
                                {{ $userCount->where('role', 'Student')->where('status', 'Pending Interview')->count() }}
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


                <div class="flex mx-4 mb-4" id="navLinks">

                    <a href="{{ route('admin.dashboard.pending-interview') }}"
                        class="font-poppins  text-slate-500 nav-link   whitespace-nowrap">Pending Interview</a>
                    <a href="{{ route('admin.dashboard.show-review') }}"
                        class="font-poppins active  text-slate-500 nav-link whitespace-nowrap">Review Interview</a>



                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>

                <div class="flex justify-between mx-4 my-2">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Interviewed Applicant</h1>
                    @include('admin.partials.select-acad-year', [
                        'route' => 'admin.dashboard.show-review',
                    ])

                </div>




                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">ID</td>
                                    <td class="px-6 py-2">Applicant</td>
                                    <td class="px-6 py-2">Date of Interview </td>
                                    <td class="px-6 py-2">Time</td>
                                    <td class="px-6 py-2">Actions</td>
                                </tr>
                            </thead>

                            <tbody class="text-left ">
                                @if ($users->count() == 0)
                                    <tr>
                                        <td></td>
                                        <td class="">

                                            <p class="my-3">No Data found in the database</p>

                                        </td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($users as $index => $user)
                                        <tr
                                            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                            <td class="px-6 py-3">{{ $user->id }}</td>
                                            <td class="px-6 py-3 ">{{ $user->last_name . ', ' . $user->first_name }}
                                            </td>

                                            @if ($user->qualifiedStudent->exam_schedule_date != null)
                                                <td class="px-6 py-3  whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->qualifiedStudent->exam_schedule_date)->format('F j, Y') }}
                                                </td>

                                                <td class="px-6 py-3    whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->qualifiedStudent->start_time)->format('h:i A') }}


                                                </td>
                                            @else
                                                <td class="px-6 py-3   whitespace-nowrap">
                                                    Not yet scheduled
                                                </td>
                                                <td class="px-6 py-3   whitespace-nowrap">

                                                </td>
                                            @endif


                                            <td class="px-6 py-3 text-[#626B7F]">
                                                {{-- <a href="" class="mx-2" title="Schedule"><i
                                            class='bx bx-calendar-check'></i></a> --}}
                                                <a class="mx-1 hover:text-green-400"
                                                    href="{{ route('admin.dashboard.edit-screening-form', $user->id) }}"
                                                    title="Edit Interview">
                                                    <i class='bx bx-edit'></i>
                                                </a>

                                                <a href="{{ route('admin.dashboard.read-interview', $user->id) }}">
                                                    <i class='bx bx-show'></i></a>


                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <nav
                            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">

                            <a href="{{ $users->previousPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Previous</span>

                            </a>

                            <div class="flex">
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <a href="{{ $users->url($i) }}"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $users->currentPage() ? 'bg-slate-100' : '' }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                            </div>
                            <a href="{{ $users->nextPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Next</span>
                            </a>
                        </nav>
                    </div>

                </div>

            </section>

        </div>



    </body>

</html>
