<div class="">
    <div id="addApplicantContent"
        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">





        <div class="bg-white mx-auto text-center rounded-[12px] w-[520px] h-[450px] p-4 border   border-[#D9DBE3]  ">
            <div class="relative text-center mx-auto font-poppins text-[24px] font-semibold  text-[#26386A] uppercase">
                <h1>Add Applicant</h1>
                <button id="closePopup" class="absolute top-0 right-0"><i
                        class='bx bx-x bx-sm text-[#26386A]'></i></button>
            </div>
            <form action="{{ route('admin.dashboard.store-applicant') }}" method="POST">
                @csrf
                <div class=" px-8 flex justify-between gap-4 mt-6 ">
                    <div class="relative   w-full">
                        <input type="text" name="firstName"
                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                            placeholder="First Name" required autocomplete="off">

                    </div>

                    <div class="relative  w-full">
                        <input type="text" name="lastName"
                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                            placeholder="Last Name" required autocomplete="off">

                    </div>



                </div>


                <div class="relative px-8 my-4 w-full">
                    <input type="text" name="email"
                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                        placeholder="Email Address" required autocomplete="off">

                </div>

                {{-- <div class="relative px-8 my-4 w-full">
                <input type="text" name="contactNumber"
                    class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                    placeholder="Contact Number" required autocomplete="off">

            </div> --}}


                <div class=" px-8 flex justify-between gap-4 my-4">


                    <div class="relative w-full">
                        <input type="number" name="rawScore"
                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                            placeholder="Raw Score" required autocomplete="off" min="1" max="100"
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
                            placeholder="Percentage" required autocomplete="off" min="1" max="100"
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
                        <option value="" selected disabled>Select Measure B Score </option>
                        <option value="5">Excellent</option>
                        <option value="4">Above Average</option>
                        <option value="3">Average</option>
                        <option value="2">Below Average</option>
                        <option value="1">Not applicable</option>

                    </select>
                </div>
                <div class="px-8 my-6">
                    <input type="submit" value="Submit"
                        class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                </div>
            </form>
        </div>





    </div>
</div>
<script>
    window.onload = function() {
        document.getElementById("addApplicantBtn").addEventListener("click", () => {
            document.getElementById("addApplicantContent").classList.remove("hidden");
        });

        document.getElementById("closePopup").addEventListener("click", () => {
            document.getElementById("addApplicantContent").classList.add("hidden");
        });
    };
</script>
