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


        @include('layout.sidenav', ['active' => 0])
        <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

            <div class="flex items-center  ">
                <form method="get" action="{{ route('admin.dashboard.show-applicant') }}" class="relative w-[300px]">
                    @csrf
                    <input type="text" name="searchTerm" placeholder="Search Here"
                        value="{{ request('searchTerm') }}"
                        class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                </form>
            </div>

            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
            </div>

        </nav>


        <section class="ml-[218px] main ">

            <div class="flex-row md:flex justify-evenly my-4 ">

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Interviews</h1>


                    <div class="flex items-end gap-3 text-[#718297] mb-8">
                        <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $users->count() }}</p>
                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>
                <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Interviews</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297] ">
                        <i class='bx bxs-user-check text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $users->count() }} </p>
                    </div>
                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>


                </div>



                <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                    <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Finished Interviews</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297]">
                        <i class='bx bxs-archive-in text-[30px] pb-2'></i>
                        <p class="text-[36px] py-0">{{ $users->count() }}</p>


                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>
            </div>
            <div class="flex justify-between mx-4 mt-4 mb-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Applicants</h1>



            </div>

            <form action="{{route('admin.dashboard.schedule-applicant')}}" method="POST">
                @csrf
                <div class="mx-4 my-2 ">
                    <a disabled id="openPopup"
                        class="w-[120px] border border-[#D9DBE3] hover:border-slate-400 flex items-center text-[14px] tezt-poppin hover:text-[#384b94] font-poppins text-slate-600 py-1 px-4 rounded-lg">
                        <i class='bx bx-user-check text-[16px] pr-1'></i></i>Schedule
                    </a>
                </div>

            <div class="flex mx-4 mb-4" id="navLinks">

                
                <a href="{{route('admin.dashboard.show-interview')}}"
                class="font-poppins active  text-slate-500  nav-link whitespace-nowrap">Schedule Interview</a>
                <a href="{{route('admin.dashboard.pending-interview')}}"
                    class="font-poppins  text-slate-500 nav-link   whitespace-nowrap">Pending Interview</a>
                <a href="{{route('admin.dashboard.show-review')}}"
                class="font-poppins   text-slate-500 nav-link whitespace-nowrap">Review Interview</a>
               

                <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
            </div>

            <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                <div class="overflow-x-auto">
                    <table
                        class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                        <thead
                            class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                            <tr>
                               <td class="px-6 py-2 ">
                                    <div class="flex items-center">
                                        <input id="default-checkbox" type="checkbox" value="" name="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                      
                                    </div>
                                </td>
                                <td class="px-6 py-2">ID</td>
                                <td class="px-6 py-2">Applicant Name</td>
                                <td class="px-6 py-2">Interview & Exam Schedule</td>
                                <td class="px-6 py-2">Time</td> 
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
                                                <input id="default-checkbox" name="selectedUsers[]" type="checkbox" value="{{$user->id}}" class="user-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-3">{{ $user->id }}</td>
                                        <td class="px-6 py-3 ">{{ $user->last_name . ', ' . $user->first_name }} </td>
                                        
                                        @if ($user->qualifiedStudent->exam_schedule_date != null)
                                                <td class="px-6 py-3  whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->qualifiedStudent->exam_schedule_date)->format('F j, Y') }}
                                                </td>

                                                <td class="px-6 py-3    whitespace-nowrap">

                                                    {{ \Carbon\Carbon::parse($user->qualifiedStudent->start_time)->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($user->qualifiedStudent->end_time)->format('h:i A') }}

                                                </td>
                                        @else
                                                <td class="px-6 py-3   whitespace-nowrap">
                                                    Not yet scheduled
                                                </td>
                                                <td class="px-6 py-3   whitespace-nowrap">
                                                   
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

              
                <!-- Create the popup for scheduling -->
                <div id="popup"
                    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div class="bg-white rounded-lg p-4">
                        <span class="cursor-pointer absolute top-2 right-2 text-gray-600"
                            id="closePopup">&times;</span>
                        <h2 class="text-lg font-semibold mb-4">Schedule Exam and Interview</h2>

                        <div>
                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-600">Date:</label>
                                <input type="date" name="date" class="w-full px-3 py-2 border rounded-md"
                                    required>


                                <div>
                                    <label for="start_time">Start Time:</label>
                                    <input type="time" id="start_time" name="start_time" required>

                                    <label for="end_time">End Time:</label>
                                    <input type="time" id="end_time" name="end_time" required>
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
