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
                'route' => 'admin.dashboard.show-schedule-interview',
                'show' => true,
            ])

            <section class="sm:ml-64 main">

                @include('layout.popup')

                @include('layout.schedule-interview-count')

                <div class="flex mx-4 mb-4" id="navLinks">



                    <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                        class="font-poppins active  text-slate-500  nav-link whitespace-nowrap">Schedule
                        Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-interview') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled Interview</a>
                    <a href="{{ route('admin.dashboard.show-scheduled-calendar') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled
                        Date</a>

                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>

                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Interviews</h1>

                    <div class="flex justify-between items-center gap-2 mx-4 ">
                        <div class="w-[180px]">
                            @include('admin.partials.select-acad-year', [
                                'route' => 'admin.dashboard.show-schedule-interview',
                            ])
                        </div>
                        <div class=" my-2 sm:w-[80px]  ">
                            <a disabled id="openPopup"
                                class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 cursor-pointer text-white ">
                                Schedule
                            </a>
                        </div>
                    </div>



                </div>


                <form action="{{ route('admin.dashboard.schedule-applicant') }}" method="POST">
                    @csrf

                    <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                                <thead
                                    class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                    <tr>
                                        <td class="px-6 py-2 ">
                                            <div class="flex items-center">
                                                <input id="default-checkbox" type="checkbox" value=""
                                                    name=""
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">

                                            </div>
                                        </td>

                                        <td class="px-6 py-2">Applicant Name</td>
                                        <td class="px-6 py-2">Email</td>
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
                                                <td class="px-6 py-3 w-[40px]">
                                                    <div class="flex items-center">
                                                        <input id="default-checkbox" name="selectedUsers[]"
                                                            type="checkbox" value="{{ $user->user_id }}"
                                                            class="user-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                                    </div>
                                                </td>


                                                <td class="px-6 py-3 ">
                                                    {{ $user->last_name . ', ' . $user->first_name }} </td>

                                                <td class="px-6 py-3 ">
                                                    {{ $user->email }}

                                                </td>


                                                <td class="px-6 py-3 ">

                                                    <a href="{{ route('admin.dashboard.show-scheduler-applicant-individual', $user->user_id) }}"
                                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>



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
                                {{-- Next Page Link --}}


                            </nav>
                        </div>


                        <!-- Create the popup for scheduling -->
                        <div id="popup"
                            class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                            <div class="bg-white rounded-lg p-4">
                                <span class="cursor-pointer absolute top-2 right-2 text-gray-600"
                                    id="closePopup">&times;</span>
                                <h2 class="text-lg font-semibold mb-4">Schedule Exam and Interview</h2>

                                <div>
                                    <div class="mb-4">
                                        <label for="date"
                                            class="block text-sm font-medium text-gray-600">Date:</label>
                                        <input type="date" name="date" class="w-full px-3 py-2 border rounded-md"
                                            required min="<?= date('Y-m-d') ?>">



                                        <div class="my-2 ">
                                            <label for="start_time">Time:</label>
                                            <input type="time" id="start_time" name="start_time" class="w-full"
                                                value="07:30" required>


                                        </div>

                                        <div class="my-2">
                                            <label for="location">Location:</label>
                                            <input type="text" id="location" name="location" class="w-full"
                                                required>

                                        </div>





                                    </div>
                                    <button type="submit"
                                        class="bg-[#2B6CE6] text-white px-4 py-2 rounded-md hover:bg-[#134197] transition-colors duration-200">Submit</button>
                                    <button type="button" id="cancelSchedule"
                                        class="bg-gray-300 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors duration-200 ml-2">Cancel</button>
                                </div>
                            </div>
                        </div>


                </form>






            </section>

        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get the checkboxes and the button
                const checkboxes = document.querySelectorAll('input[name="selectedUsers[]"]');
                const approveBtn = document.getElementById('approveBtn');

                // Add a change event listener to each checkbox
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        // Check if any checkbox is selected
                        const anyCheckboxSelected = Array.from(checkboxes).some(checkbox => checkbox
                            .checked);

                        // Update the button's disabled state
                        approveBtn.disabled = !anyCheckboxSelected;
                    });
                });

                selectAllCheckbox.addEventListener('click', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;

                    });
                    approveBtn.disabled = !selectAllCheckbox.checked;
                });
            });


            const selectAllCheckbox = document.getElementById('default-checkbox');
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');


            function updateSelectAllCheckbox() {
                selectAllCheckbox.checked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            }



            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function() {
                    updateSelectAllCheckbox();
                });
            });


            document.getElementById("openPopup").addEventListener("click", function() {
                document.getElementById("popup").classList.remove("hidden");
            });

            // Close the popup when the close button is clicked
            document.getElementById("closePopup").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });

            // Close the popup when the cancel button is clicked
            document.getElementById("cancelSchedule").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });

            // Handle the submit button
        </script>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>

    </body>

</html>
