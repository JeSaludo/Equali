<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | AddQuestion </title>
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
            @include('layout.danger-alert')

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Edit Applicant </h1>

                <div class="my-2">

                    @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="mt-5 w-6/12 right-0 mx-auto    transition-all transform  delay-150 ease-linear">
                    <form action="{{ route('admin.dashboard.update-applicant', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="bg-white mx-4 rounded-[12px] mt-4  h-[450px] p-4 border-gray-600 border-2">
                            <div
                                class="text-center mx-auto font-poppins text-[28px] font-semibold  text-[#26386A] uppercase">
                                <h1>Edit Information </h1>

                            </div>

                            <div class=" px-8 flex justify-between gap-4 mt-6 ">
                                <div class="relative   w-full">
                                    <input type="text" name="firstName"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                        placeholder="First Name" required autocomplete="off"
                                        value={{ $user->first_name }}>

                                </div>

                                <div class="relative  w-full">
                                    <input type="text" name="lastName"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                        placeholder="Last Name" required autocomplete="off"
                                        value={{ $user->last_name }}>

                                </div>



                            </div>


                            <div class="relative px-8 my-4 w-full">
                                <input type="text" name="email"
                                    class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                    placeholder="Email Address" required autocomplete="off" value="{{ $user->email }}">

                            </div>

                            {{-- <div class="relative px-8 my-4 w-full">
                            <input type="text" name="contactNumber"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                placeholder="Contact Number" required autocomplete="off"
                                value="{{ $user->contact_number }}">

                        </div> --}}

                            <div class=" px-8 flex justify-between gap-4 my-4">


                                <div class="relative w-full">
                                    <input type="number" name="rawScore"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
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
                                    <input type="number" name="percentage"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
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

                            <div class="relative mx-8 ">
                                <select name="measure_b_score" required
                                    class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0]">

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


                            <div class="px-8 my-6">
                                <input type="submit" value="Submit"
                                    class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">


                            </div>


                        </div>



                    </form>

                </div>


            </section>

        </div>

    </body>

</html>
