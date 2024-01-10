<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Update Waitlisted Status </title>
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

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Dean Dashboard </h1>

                <div class="my-2">

                    @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="my-6  mx-4   ">
                    <form action="{{ route('admin.dashboard.update-applicant', $user->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="bg-white mx-4 rounded-[12px] mt-4  p-4 border-gray-100 border-2">
                            <div class=" font-poppins text-[22px] flex justify-between font-semibold  text-[#26386A] ">
                                <h1>Applicant Details </h1>
                                <a href="{{ route('admin.dashboard.admission') }}"
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

                </div>

                <div class="mt-4 mb-6   mx-4 ">
                    <div class="bg-white mx-4 rounded-[12px] mt-4  p-4 border-gray-100 border-2">
                        <div class=" font-poppins text-[22px] font-semibold  text-[#26386A] ">
                            <h1>Applicant Exam and Interview Details</h1>

                        </div>

                        <div class=" px-8 flex justify-between gap-4 mt-6 ">
                            <div class="relative   w-full">
                                <label for="quali" class="font-poppins text-[14px] text-gray-500 ">Qualifying
                                    Exam Score:</label>
                                <input type="text" name="quali"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Email Address" required autocomplete="off" disabled
                                    value="{{ $user->result->scaled_exam_score }}">

                            </div>

                            <div class="relative  w-full">
                                <label for="weighted_score" class="font-poppins text-[14px] text-gray-500 ">
                                    Weighted Score:</label>
                                <input type="text" name="weighted_score"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Contact Number" required autocomplete="off" disabled
                                    value="{{ $user->result->measure_c_score }}">
                            </div>


                        </div>

                        <div class=" px-8 flex justify-between gap-4 mt-6 ">
                            <div class="relative   w-full">
                                <label for="interview" class="font-poppins text-[14px] text-gray-500 ">Interview
                                    Score:</label>
                                <input type="text" name="interview"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Email Address" required autocomplete="off" disabled
                                    value="{{ $user->studentInfo->average_score }}">

                            </div>

                            <div class="relative  w-full">
                                <label for="weighted" class="font-poppins text-[14px] text-gray-500 ">
                                    Weighted Score:</label>
                                <input type="text" name="weighted"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Contact Number" required autocomplete="off" disabled
                                    value="{{ $user->result->measure_b_score }}">
                            </div>


                        </div>

                        <div class=" px-8 flex justify-between gap-4 mt-6 ">
                            <div class="relative   w-full">
                                <label for="interview" class="font-poppins text-[14px] text-gray-500 ">Admission
                                    Score:</label>
                                <input type="text" name="interview"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Email Address" required autocomplete="off" disabled
                                    value="{{ $user->result->admission_score }}">

                            </div>

                            <div class="relative  w-full">
                                <label for="weighted" class="font-poppins text-[14px] text-gray-500 ">
                                    Weighted Score:</label>
                                <input type="text" name="weighted"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Contact Number" required autocomplete="off" disabled
                                    value="{{ $user->result->measure_a_score }}">
                            </div>


                        </div>

                        <div class=" px-8 flex justify-between gap-4 mt-6 ">
                            <div class="relative   w-full">
                                <label for="interview" class="font-poppins text-[14px] text-gray-500 ">Total Weighted
                                    Average
                                    :</label>
                                <input type="text" name="interview"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Email Address" required autocomplete="off" disabled
                                    value="{{ $user->result->weighted_average }}">

                            </div>




                        </div>
                    </div>
                </div>
                <div>

                </div>
                <form class="mx-4 mt-4"
                    action="{{ route('admin.dashboard.update-waitlisted-applicant', $user->id) }}" method="POST">

                    @csrf
                    @method('put')

                    <div class="bg-white mx-4 rounded-[12px]   p-4 border-gray-100 border-2">
                        <div class=" font-poppins text-[22px] font-semibold  text-[#26386A] ">
                            <h1>Applicant Status Update </h1>

                        </div>

                        <div>

                            <div class="relative px-8 my-4 w-full">
                                <label for="admission" class="font-poppins text-[14px] text-gray-500 ">
                                    Status:</label>
                                <select name="status"
                                    class="border font-poppins border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    autocomplete="off">
                                    <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                    <option value="Unqualified">Unqualified</option>
                                    <option value="Qualified">Qualified</option>


                                </select>

                            </div>
                        </div>
                        <div class="  w-full flex justify-end">
                            <div class=" pt-4 pr-6 w-full flex justify-end">
                                <input type="submit" value="Update "
                                    class="text-white bg-blue-700 hover:bg-blue-800 font-poppins focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2   focus:outline-none ">


                            </div>
                        </div>
                    </div>
                </form>






        </div>



        </form>

        </div>





        </section>

        </div>

    </body>

</html>
