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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
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

                {{-- @include('layout.schedule-interview-count') --}}

                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Scheduled Date</h1>



                </div>




                <div class="flex mx-4 mb-4" id="navLinks">



                    <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Schedule
                        Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-interview') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-date') }}"
                        class="font-poppins  active text-slate-500  nav-link whitespace-nowrap">Scheduled
                        Date</a>

                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>


                <div class="mx-4 my-4">

                    <form action="{{ route('admin.dashboard.show-scheduled-date') }}" method="get">
                        @csrf

                        <form id="dateFilterForm">
                            <input type="date" name="selectDate" id="selectDate"
                                class="p-2 border text-gray-500 rounded-md mr-2"
                                value="{{ old('selectDate', $selectedDate ?? '') }}" oninput="updateStoredDate()">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                                Filter
                            </button>
                        </form>

                        <script>
                            // Function to update stored date in local storage
                            function updateStoredDate() {
                                var selectedDate = document.getElementById('selectDate').value;
                                localStorage.setItem('selectedDate', selectedDate);
                            }

                            // On page load, set the date input value from local storage
                            document.addEventListener('DOMContentLoaded', function() {
                                var storedDate = localStorage.getItem('selectedDate');
                                if (storedDate) {
                                    document.getElementById('selectDate').value = storedDate;
                                }
                            });
                        </script>
                    </form>







                </div>
                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full font-poppins border-collapse text-md text-left rtl:text-right text-gray-500 table-auto">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>

                                    <td class="px-6 py-2">Slot No. </td>

                                    <td class="px-6 py-2">Scheduled Date </td>
                                    <td class="px-6 py-2">Start Time </td>
                                    <td class="px-6 py-2">Applicant Name</td>
                                    <td class="px-6 py-2">Email</td>
                                    <td class="px-6 py-2">Action</td>


                                </tr>
                            </thead>
                            <tbody class="text-left">

                                @if ($users->isEmpty())
                                    <tr>
                                        <td class="px-6 py-2">No Data Found</td>

                                    </tr>
                                @else
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td class="px-6 py-2">{{ $index + 1 }}
                                            <td class="px-6 py-2">
                                                {{ date('F j, Y', strtotime($user->exam_schedule_date)) }}</td>
                                            <td class="px-6 py-2">
                                                {{ \Carbon\Carbon::parse($user->start_time)->format('g:i A') }}
                                            </td>



                                            <td class="px-6 py-2">{{ $user->last_name . ', ' . $user->first_name }}
                                            </td>
                                            <td class="px-6 py-2">{{ $user->email }}</td>
                                        </tr>
                                    @endforeach


                                @endif




                            </tbody>
                        </table>




                        <nav
                            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">


                            <p class="font-poppins  text-[14px] p-2 text-gray-500 mx-2 font-bold">Max Slot For This
                                Day:

                                {{ $slotLimit }}</p>

                        </nav>





                    </div>
                </div>







            </section>

        </div>







        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>

    </body>

</html>
