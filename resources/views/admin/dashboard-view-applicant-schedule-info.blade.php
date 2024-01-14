<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Edit Applicant </title>
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
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')

            @include('layouts.sidebar')


            @include('layouts.navigation', [
                'route' => null,
                'show' => false,
            ])
            <section class="sm:ml-64 main">

                @include('layout.popup')

                <div class="my-6  mx-4   ">
                    <form action="{{ route('admin.dashboard.update-applicant', $user->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="bg-white mx-4 rounded-[12px] mt-4  p-4 border-gray-100 border-2">
                            <div class=" font-poppins text-[22px] flex justify-between font-semibold  text-[#26386A] ">
                                <h1>Applicant Details </h1>
                                <a href="{{ route('programhead.admission') }}"
                                    class="text-white bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Back</a>
                            </div>

                            <div class=" px-8 flex justify-between gap-4 mt-6 ">
                                <div class="relative   w-full">
                                    <label for="first_name" class="font-poppins text-[14px] text-gray-500 ">First
                                        Name:</label>
                                    <input type="text" name="firstName"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="First Name" required autocomplete="off"
                                        value={{ $user->first_name }}>

                                </div>

                                <div class="relative  w-full">
                                    <label for="last_name" class="font-poppins text-[14px] text-gray-500 ">Last
                                        Name:</label>
                                    <input type="text" name="lastName"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Last Name" required autocomplete="off"
                                        value={{ $user->last_name }}>

                                </div>



                            </div>

                            <div class=" px-8 flex justify-between gap-4 mt-6 ">
                                <div class="relative   w-full">
                                    <label for="email" class="font-poppins text-[14px] text-gray-500 ">Email
                                        Address:</label>
                                    <input type="text" name="email"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Email Address" required autocomplete="off"
                                        value="{{ $user->email }}">

                                </div>

                                <div class="relative  w-full">
                                    <label for="contactNumber" class="font-poppins text-[14px] text-gray-500 ">
                                        Contact Number:</label>
                                    <input type="text" name="contactNumber"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Contact Number" required autocomplete="off"
                                        value="{{ $user->contact_number }}" oninput="validateNumber(this)"
                                        minlength="11" maxlength="11">
                                </div>

                                <script>
                                    function validateNumber(input) {
                                        input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
                                    }
                                </script>
                            </div>



                            <div class=" px-8 flex justify-between gap-4 my-4">


                                <div class="relative w-full">
                                    <label for="rawScore" class="font-poppins text-[14px] text-gray-500 ">
                                        Raw Score:</label>
                                    <input type="number" name="rawScore"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Raw Score" required autocomplete="off" min="1"
                                        value="{{ $user->admissionExam->raw_score }}" max="100"
                                        oninput="checkRawScore(this.value)">

                                    @error('rawScore')
                                        <label for="rawScore" class="text-red-500 text-sm">{{ $message }}</label>
                                    @enderror

                                    <div id="rawScoreWarning" class="text-red-500 text-sm hidden">
                                        Warning: Raw Score should be between 1 and 100.
                                    </div>
                                </div>

                                <div class="relative w-full">
                                    <label for="percentage" class="font-poppins text-[14px] text-gray-500 ">
                                        Percentage:</label>
                                    <input type="number" name="percentage"
                                        class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Percentage" required autocomplete="off" min="1"
                                        value="{{ $user->admissionExam->percentage }}" max="100"
                                        oninput="checkPercentage(this.value)">

                                    @error('percentage')
                                        <label for="percentage" class="text-red-500 text-sm">{{ $message }}</label>
                                    @enderror

                                    <div id="percentageWarning" class="text-red-500 text-sm hidden">
                                        Warning: Percentage should be between 1 and 100.
                                    </div>
                                </div>

                                <script>
                                    function checkRawScore(value) {
                                        // Reset warning
                                        document.getElementById("rawScoreWarning").classList.add("hidden");

                                        // Check if value is outside the range
                                        if (value < 1 || value > 100) {
                                            document.getElementById("rawScoreWarning").classList.remove("hidden");
                                        }
                                    }

                                    function checkPercentage(value) {
                                        // Reset warning
                                        document.getElementById("percentageWarning").classList.add("hidden");

                                        // Check if value is outside the range
                                        if (value < 1 || value > 100) {
                                            document.getElementById("percentageWarning").classList.remove("hidden");
                                        }
                                    }
                                </script>







                            </div>

                            <div class="relative mx-8 selection: ">
                                <label for="admission" class="font-poppins text-[14px] text-gray-500 ">
                                    Measure B Score:</label>
                                <select name="measure_b_score" required
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                    <option value="5"
                                        {{ $user->admissionExam->measure_b_score == '5' ? 'selected' : '' }}>Excellent
                                    </option>
                                    <option value="4"
                                        {{ $user->admissionExam->measure_b_score == '4' ? 'selected' : '' }}>Above
                                        Average</option>
                                    <option value="3"
                                        {{ $user->admissionExam->measure_b_score == '3' ? 'selected' : '' }}>Average
                                    </option>
                                    <option value="2"
                                        {{ $user->admissionExam->measure_b_score == '2' ? 'selected' : '' }}>Below
                                        Average</option>
                                    <option value="1"
                                        {{ $user->admissionExam->measure_b_score == '1' ? 'selected' : '' }}>Not
                                        applicable</option>

                                </select>
                            </div>


                            <div class=" pt-4 pr-6 w-full flex justify-end">
                                <input type="submit" value="Update Applicant"
                                    class="text-white bg-blue-700 hover:bg-blue-800 font-poppins focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2   focus:outline-none ">
                            </div>


                        </div>



                    </form>






                    <form action="{{ route('admin.dashboard.schedule-applicant-individual', $user->id) }}"
                        method="POST">
                        @csrf

                        <div class="bg-white mx-4 rounded-[12px] mt-4 p-4 border-gray-100 border-2">
                            <div class="font-poppins text-[22px] flex justify-between font-semibold text-[#26386A] ">
                                <h1>Schedule Exam and Interview</h1>
                            </div>
                            <div class="px-8 mt-4">

                                <div class="mb-4">
                                    <label for="date"
                                        class="block text-sm font-medium text-gray-600">Date:</label>
                                    <input type="date" name="date" class="w-full px-3 py-2 border rounded-md"
                                        required min="<?= date('Y-m-d') ?>">
                                </div>

                                <div class=" flex justify-between gap-4 mt-6">
                                    <div class="my-2 w-full">
                                        <label for="start_time"
                                            class="block text-sm font-medium text-gray-600">Time:</label>
                                        <input type="time" id="start_time" name="start_time"
                                            class="w-full px-3 py-2 border rounded-md" required value="07:30">
                                    </div>

                                    <div class="my-2 w-full">
                                        <label for="location"
                                            class="block text-sm font-medium text-gray-600">Location:</label>
                                        <input type="text" id="location" name="location"
                                            placeholder="Enter Exam and interview location"
                                            class="w-full px-3 py-2 border rounded-md" required>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4  w-full">
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 font-poppins focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2   focus:outline-none ">Set
                                        Schedule</button>
                                </div>
                            </div>
                        </div>
                    </form>




                </div>


            </section>

        </div>

    </body>

</html>
