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
        @vite('resources/css/app.css')

    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <div class="flex items-center  ">
                    <form method="get" action="" class="relative w-[300px]">
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
                @include('layout.schedule-interview-count')

                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Interviews</h1>



                </div>

                <form action="{{ route('admin.dashboard.schedule-applicant') }}" method="POST">
                    @csrf

                    <div class="flex mx-4 mb-4" id="navLinks">



                        <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                            class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Schedule Interview</a>
                        <a href="{{ route('admin.dashboard.show-scheduled-interview') }}"
                            class="font-poppins  active text-slate-500  nav-link whitespace-nowrap">Scheduled
                            Interview</a>
                        <a href="{{ route('admin.dashboard.show-scheduled-date') }}"
                            class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled
                            Date</a>
                        <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                    </div>

                    <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                                <thead
                                    class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                    <tr>

                                        <td class="px-6 py-2">ID</td>
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


                                                <td class="px-6 py-3">{{ $user->id }}</td>
                                                <td class="px-6 py-3 ">
                                                    {{ $user->last_name . ', ' . $user->first_name }} </td>

                                                @if ($user->qualifiedStudent->exam_schedule_date != null)
                                                    <td class="px-6 py-3  whitespace-nowrap">

                                                        {{ \Carbon\Carbon::parse($user->qualifiedStudent->exam_schedule_date)->format('F j, Y') }}
                                                    </td>

                                                    <td class="px-6 py-3    whitespace-nowrap">

                                                        {{ \Carbon\Carbon::parse($user->qualifiedStudent->start_time)->format('h:i A') }}



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
            document.getElementById("submitSchedule").addEventListener("click", function() {
                // You can add your submit logic here
                // For example, you can retrieve the event name from the input field
                var eventName = document.getElementById("event").value;

                // Close the popup
                document.getElementById("popup").classList.add("hidden");

                // You can do something with the event name, e.g., save it to a database
                console.log("Event Name: " + eventName);
            });
        </script>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
