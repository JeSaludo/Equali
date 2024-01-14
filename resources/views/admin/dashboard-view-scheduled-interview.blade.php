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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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

    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')

            @include('layouts.sidebar')

            @include('layouts.navigation', [
                'route' => 'admin.dashboard.show-scheduled-interview',
                'show' => true,
            ])


            <section class="sm:ml-64 main">

                @include('layout.popup')
                @include('layout.schedule-interview-count')






                <div class="flex mx-4 mb-4" id="navLinks">



                    <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Schedule Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-interview') }}"
                        class="font-poppins  active text-slate-500  nav-link whitespace-nowrap">Scheduled
                        Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-calendar') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled
                        Date</a>
                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>


                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Interviews</h1>
                    <div class="w-2/12">
                        @include('admin.partials.select-acad-year', [
                            'route' => 'admin.dashboard.show-scheduled-interview',
                        ])
                    </div>


                </div>


                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>


                                    <td class="px-6 py-2">Applicant Name</td>
                                    <td class="px-6 py-2">Interview & Exam Schedule</td>
                                    <td class="px-6 py-2">Time</td>
                                    <td class="px-6 py-2">Action</td>
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



                                            <td class="px-6 py-3 ">
                                                {{ $user->last_name . ', ' . $user->first_name }} </td>

                                            @if ($user->exam_schedule_date != null)
                                                <td class="px-6 py-3  whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->exam_schedule_date)->format('F j, Y') }}
                                                </td>

                                                <td class="px-6 py-3    whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->start_time)->format('h:i A') }}



                                                </td>

                                                <td class="px-6 py-3   whitespace-nowrap flex items-center gap-3">


                                                    <a href="{{ route('admin.dashboard.reschedule-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to resched this user?')"
                                                        title="Reschedule" class="mx-1 hover:text-green-400"><i
                                                            class='bx bx-calendar-edit'></i></a>
                                                    <a class="hover:text-red-400 mx-1"
                                                        href="{{ route('admin.dashboard.unqualify-applicant', $user->id) }}"
                                                        title="Reject "
                                                        onclick="return confirm('Are you sure you want to unqualify this user?')">
                                                        <i class='bx bx-user-x bx-sm'></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td class="px-6 py-3   whitespace-nowrap">
                                                    Not yet scheduled
                                                </td>
                                            @endif



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
                            {{-- Next Page Link --}}


                        </nav>
                    </div>
            </section>

        </div>








        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
