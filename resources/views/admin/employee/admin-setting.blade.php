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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        <style>
            /* Styles for the unselected state */
            ul[role="tablist"] li[role="presentation"] button[aria-selected="false"] {
                border-color: #ccc;
                color: #718096;
            }

            /* Styles for the selected state */
            ul[role="tablist"] li[role="presentation"] button[aria-selected="true"] {
                border-color: #26386a;
                color: #26386a;
            }
        </style>

    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')
            @include('layouts.sidebar')


            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">
                @include('layout.user-popup')



            </nav>
            <section class="sm:ml-64 main">

                @include('layout.popup')
                <div class="mx-auto my-8 text-center w-9/12   bg-white border rounded-lg  border-[#D9DBE3]">
                    <div class="mb-4 border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                            data-tabs-toggle="#default-tab-content" role="tablist">
                            <li class="me-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                    aria-controls="settings" aria-selected="false">Academic Year</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Exam</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-[#26386a]"
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">Admission</button>
                            </li>


                        </ul>
                    </div>
                    <form id="settingForm" class=" text-left" action="{{ route('admin.update.setting') }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div id="default-tab-content">



                            <div class="hidden p-4 h-[440px] rounded-lg bg-gray-50" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="">
                                    <div class="text-left   mb-4">
                                        <h1 class="text-[22px] font-poppins  px-6 font-semibold text-[#26386A]">
                                            Exam
                                            Setting
                                        </h1>
                                        <p class="text-[14px] font-poppins  px-6 font-normal text-gray-500">Edit your
                                            exam
                                            setting
                                            here
                                        </p>
                                    </div>


                                    <div class="px-6 w-4/12">
                                        <label for="" class="my-0 text-gray-600 font-poppins ">Exam Passing
                                            Score:</label>
                                        <div class=" w-full  mb-4 mt-1">
                                            <input type="number" name="qualifying_passing_score"
                                                value="{{ $option->qualifying_passing_score }}"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Passing Score" required autocomplete="off">

                                        </div>



                                        <label for="" class="my-0 text-gray-600 font-poppins ">Number of Exam
                                            Items:</label>
                                        <div class=" w-full  mb-4 mt-1">
                                            <input type="number" name="qualifying_number_of_items"
                                                value="{{ $option->qualifying_number_of_items }}"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Enter number of exam items" required autocomplete="off">

                                        </div>

                                        <label for="exam_timer" class="my-0 text-gray-600 font-poppins">Exam Timer (in
                                            minutes):</label>
                                        <div class="w-full mb-4 mt-1">
                                            <input type="number" name="qualifying_timer"
                                                value="{{ $option->qualifying_timer }}"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Enter exam duration in minutes" required
                                                autocomplete="off">
                                        </div>



                                    </div>
                                </div>

                                <div class="flex justify-end  my-6  w-full px-4 py-2 ">
                                    <input type="submit" value="Save"
                                        class="text-lg  font-poppins font-normal mr-2 w-3/12 h-[45px] rounded-md bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg h-[440px] bg-gray-50 " id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">

                                <div class="">
                                    <div class="text-left   mb-4">
                                        <h1 class="text-[22px] font-poppins  px-6 font-semibold text-[#26386A]">
                                            Admission
                                            Setting
                                        </h1>
                                        <p class="text-[14px] font-poppins  px-6 font-normal text-gray-500">Edit your
                                            admission
                                            setting
                                            here
                                        </p>
                                    </div>


                                    <div class="px-6 w-4/12">
                                        <label for="" class="my-0 text-gray-600 font-poppins ">Qualified
                                            Passing
                                            Average
                                        </label>
                                        <div class=" w-full  mb-4 mt-1">
                                            <input type="number" name="qualified_student_passing_average"
                                                value="{{ $option->qualified_student_passing_average }}"
                                                step="0.01" max="5"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Enter number of exam items" required autocomplete="off">

                                        </div>

                                        <label for="" class="my-0 text-gray-600 font-poppins ">Slot per Day
                                        </label>
                                        <div class=" w-full  mb-4 mt-1">
                                            <input type="number" name="slot_per_day"
                                                value="{{ $option->slot_per_day }}"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Enter number of exam items" required autocomplete="off">

                                        </div>


                                        <label for="" class="my-0 text-gray-600 font-poppins ">Number of
                                            Qualified
                                            Applicant
                                        </label>
                                        <div class=" w-full  mb-4 mt-1">
                                            <input type="number" name="number_of_qualified"
                                                value="{{ $option->number_of_qualified }}"
                                                class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                placeholder="Enter number of exam items" required autocomplete="off">

                                        </div>



                                    </div>

                                </div>

                                <div class="flex justify-end  my-6  w-full px-4 py-2 ">
                                    <input type="submit" value="Save"
                                        class="text-lg  font-poppins font-normal mr-2 w-3/12 h-[45px] rounded-md bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>

                            </div>
                    </form>
                    <div class="hidden p-4 rounded-lg h-[490px] bg-gray-50" id="settings" role="tabpanel"
                        aria-labelledby="settings-tab">

                        <div class="">

                            <div class="text-left   mb-4">
                                <h1 class="text-[22px] font-poppins  px-6 font-semibold text-[#26386A]">
                                    Academic Year
                                    Setting
                                </h1>
                                <p class="text-[14px] font-poppins  px-6 font-normal text-gray-500">Edit your
                                    Create or Select Academic Year
                                </p>
                            </div>

                            <div class="px-6 w-7/12">
                                <form id="createAcademicYearForm" class="" method="post"
                                    action="{{ route('admin.setting.create-acad') }}">
                                    @csrf
                                    <div class="">

                                        <div class="">
                                            <div class="w-full mb-4 mt-1  ">
                                                <!-- Input field for the new academic year -->

                                                <div class="mb-4">
                                                    <label for="newAcademicYear"
                                                        class="my-0 text-gray-600 font-poppins">
                                                        Create a New Academic Year:
                                                    </label>
                                                    <input type="text" id="newAcademicYear" name="newAcademicYear"
                                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                                        placeholder="Enter the new academic year" required>


                                                </div>

                                                <div class="flex gap-4">
                                                    <div class="mb-4">
                                                        <label for="start_date"
                                                            class="my-0 text-gray-600 font-poppins ">Start
                                                            Date:</label>
                                                        <input type="date" id="start_date" name="start_date"
                                                            class="w-full rounded border border-[#D9DBE3] px-6"
                                                            required>
                                                    </div>


                                                    <div class="mb-4">
                                                        <label for="end_date"
                                                            class="my-0 text-gray-600 font-poppins  ">End
                                                            Date:</label>
                                                        <input type="date" id="end_date" name="end_date"
                                                            class="w-full rounded border border-[#D9DBE3] px-6"
                                                            required>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>

                                        <div class="mb-4 mt-1">
                                            <button type="submit"
                                                class="bg-blue-500 w-full text-white rounded px-4 py-2">Create</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <form id="settingForm" class=" text-left"
                                action="{{ route('admin.update.setting-acad') }}" method="post">
                                @csrf
                                @method('PUT')



                                <div class="px-6 w-7/12">
                                    <label for="selectAcademicYear" class="my-0 text-gray-600 font-poppins">
                                        Select an Existing Academic Year:
                                    </label>
                                    <div class="w-full mb-4 mt-1">
                                        <select id="selectAcademicYear" name="acad_year"
                                            class="h-[45px] w-full rounded border border-[#D9DBE3] px-6">

                                            @if ($academicYears->isEmpty())
                                                <option value="" disabled selected>No Existing academic year
                                                </option>
                                            @else
                                                <option value="" disabled selected>Select academic year
                                                    @foreach ($academicYears as $acadYear)
                                                <option value="{{ $acadYear->year_name }}"
                                                    {{ $acadYear->year_name == $option->academic_year_name ? 'selected' : '' }}>
                                                    {{ $acadYear->year_name . ' (' . $acadYear->start_date . ' - ' . $acadYear->end_date . ')' }}
                                                </option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div>





                                <div class="flex justify-end  my-6  w-full px-4 py-2 ">
                                    <input type="submit" value="Save"
                                        class="text-lg  font-poppins font-normal mr-2 w-3/12 h-[45px] rounded-md bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>


                            </form>
                            <!-- Form for creating a new academic year -->



                        </div>

                    </div>







                </div>



            </section>



        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


    </body>

</html>
