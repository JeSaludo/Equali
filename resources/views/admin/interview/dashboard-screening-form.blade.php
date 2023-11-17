<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Screening Form </title>
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
    <div class="min-h-screen  bg-[#EEF4F6]">


        @include('layout.sidenav')
        <div class="ml-[218px] w-auto  text-black flex justify-between ">
            <div class="mt-4">
                <h1 class="text-[#1D489A] font-poppins font-medium text-[24px] mx-8">Welcome, Name Here👋</h1>
                <p class="text-[#718297] text-[12px] font-raleway font-normal mx-8 mb-4">Check your info here</p>
            </div>
        
            <div class="mt-4">
                <form class="w-[400px]" method="get" action="">
                    @csrf
        
                   
                    <div class="relative w-full">
                    <input type="text" name="searchTerm" placeholder="Search Here" class="px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-gray-500 bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    <i class='bx bx-category-alt bx-sm text-gray-500 bx-sm absolute right-3 top-1/2 transform -translate-y-1/2'></i>
                    </div>
                </form>
            </div>
            
            <div class="mt-6">
                <h1>{{ now()->format('F j, Y') }}</h1>
              
            </div>
        
            <div class="mt-6 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M19 13.586V10C19 6.783 16.815 4.073 13.855 3.258C13.562 2.52 12.846 2 12 2C11.154 2 10.438 2.52 10.145 3.258C7.185 4.074 5 6.783 5 10V13.586L3.293 15.293C3.19996 15.3857 3.12617 15.4959 3.07589 15.6172C3.0256 15.7386 2.99981 15.8687 3 16V18C3 18.2652 3.10536 18.5196 3.29289 18.7071C3.48043 18.8946 3.73478 19 4 19H20C20.2652 19 20.5196 18.8946 20.7071 18.7071C20.8946 18.5196 21 18.2652 21 18V16C21.0002 15.8687 20.9744 15.7386 20.9241 15.6172C20.8738 15.4959 20.8 15.3857 20.707 15.293L19 13.586ZM19 17H5V16.414L6.707 14.707C6.80004 14.6143 6.87383 14.5041 6.92412 14.3828C6.9744 14.2614 7.00019 14.1313 7 14V10C7 7.243 9.243 5 12 5C14.757 5 17 7.243 17 10V14C17 14.266 17.105 14.52 17.293 14.707L19 16.414V17ZM12 22C12.6193 22.0008 13.2235 21.8086 13.7285 21.4502C14.2335 21.0917 14.6143 20.5849 14.818 20H9.182C9.38566 20.5849 9.76648 21.0917 10.2715 21.4502C10.7765 21.8086 11.3807 22.0008 12 22Z"
                        fill="#626B7F" />
                    <circle cx="18" cy="8" r="4" fill="#EA3332" />
                </svg>
            </div>
        </div>


        <section class="ml-[218px] main">
            <form action="{{ route('admin.dashboard.store-interview') }}" method="POST">
                @csrf
                <div class="bg-white mx-4">
                    <h1 class="text-center text-[#26386A] font-poppins font-bold text-2xl my-3 py-4">Screening Form</h1>
                    <div class="flex mx-4 justify-between l gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="name"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="Applicant Name:" required autocomplete="off"
                                value="{{ $user->first_name }} {{ $user->last_name }}">
                        </div>

                        <div class="relative px-4 my-2 flex w-full">
                            <div
                                class="h-[50px] py-3 w-3/12 bg-white whitespace-nowrap placeholder:text-[#4E4E4E]  px-[40px] rounded-l   border-x-2 border-y-2 border-r-2 border-[#D7D8D0]">
                                <label for="">Date</label>
                            </div>

                            <input
                                class="h-[50px] w-full  placeholder:text-[#4E4E4E]  px-[40px] rounded-r border-y-2 border-r-2 border-[#D7D8D0]"
                                type="date" name="date" class="" placeholder=":"
                                value="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                    </div>
                    <div class="flex mx-4 justify-between  gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="home_address"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="Home Address" required autocomplete="off">
                        </div>

                        <div class=" px-4 my-2 w-full">
                            <select
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="" required autocomplete="off" name="course">
                                <option value="" disabled selected>Course Applied:</option>
                                <option value="IT">Bachelor in Science of Information Technology</option>
                                <option value="IS">Bachelor in Science of Information Systems</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex mx-4 justify-between  gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="school_last_attended"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="School Last Attended:" required autocomplete="off">
                        </div>

                        <div class=" px-4 my-2 w-full">
                            <input type="text" name="school_address"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="School Address:" required autocomplete="off">
                        </div>
                    </div>
                    <div class="flex mx-4 justify-between  gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="year_graduated"
                                class="digit-only h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="Year Graduated:" required autocomplete="off">
                        </div>

                        <div class=" px-4 my-2 w-full">
                            <input type="text" name="gpa"
                                class="digit-only h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="GPA:" required autocomplete="off">
                        </div>
                    </div>

                    <div class="flex mx-4 justify-between  gap-2 ">


                        <div class="px-4 my-2 w-full">
                            <select
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                placeholder="" required autocomplete="off" name="academic_track"
                                id="academic-track">
                                <option value="" disabled selected>Academic Track:</option>
                                <option value="ABM">Accountancy, Business, and Management</option>
                                <option value="HUMSS">Humanities and Social Sciences</option>
                                <option value="STEM">Science, Technology, Engineering, and Mathematics</option>
                                <option value="GAS">General Academic Strand</option>
                                <option value="TVL">Technical Vocational Livelihood (TVL) Track</option>
                                <option value="ST">Sports Track</option>
                                <option value="ADT">Arts and Design Track</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="px-4 my-2 w-full" id="otherTrackInput" style="display:none;">
                            <input type="text"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                placeholder="Specify Academic Track" name="other_academic_track"
                                id="other-academic-track">
                        </div>

                        <script>
                            const academicTrackSelect = document.getElementById('academic-track');
                            const otherTrackInput = document.getElementById('otherTrackInput');

                            academicTrackSelect.addEventListener('change', function() {
                                if (academicTrackSelect.value === 'other') {
                                    otherTrackInput.style.display = 'block';
                                } else {
                                    otherTrackInput.style.display = 'none';
                                }
                            });
                        </script>

                    </div>
                    <div class="mx-8 my-2 font-poppins">
                        <h1 class="text-[18px]">Do you have any of the Following:</h1>
                        <div class="flex gap-2 justify-between w-8/12">
                            <div class="mt-3">
                                <label for="" class="text-[16px]">Computers:</label>
                                <div>
                                    <input type="checkbox" name="hasDesktop" id="" value="1">
                                    <label for="hasDesktop">Desktop</label>
                                </div>

                                <div>
                                    <input type="checkbox" name="hasLaptop" id="" value="1">
                                    <label for="hasLaptop">Laptop</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="" class="text-[16px]">Mobiles:</label>
                                <div>
                                    <input type="checkbox" name="hasSmartphone" id="" value="1">
                                    <label for="hasSmartphone">Smartphone</label>
                                </div>

                                <div>
                                    <input type="checkbox" name="hasTablet" id="" value="1">
                                    <label for="hasTablet">Tablet</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="text-[16px] whitespace-nowrap">Status of Internet Connectivity:</label>

                                <div>
                                    <input type="radio" name="connectivity" id="stable" value="Stable">
                                    <label for="stable">Stable</label>
                                </div>

                                <div>
                                    <input type="radio" name="connectivity" id="not_stable" value="Not Stable">
                                    <label for="not_stable">Not Stable</label>
                                </div>

                                <div>
                                    <input type="radio" name="connectivity" id="none" value="None">
                                    <label for="none">None</label>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="mx-8 text-lg">
                        <h1>Interview Guide:</h1>
                        <div class="flex justify-end my-1 ">
                            <h1 class="text-center w-[220px] ">Score</h1>
                        </div>
                        <div class="flex justify-between my-2">
                            <p>1. Background and Interest to the program</p>
                            <input type="text" name="interview1" id="interview1" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center " required>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>2. Ability to express one self</p>
                            <input type="text" name="interview2" id="interview2"
                                class="score border-2 border-[#D7D8D0] text-center " required>
                        </div>
                        <div class="flex justify-between my-2">
                            <p>3. Academic Potential</p>
                            <input type="text" name="interview3" id="interview3" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center " required>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>4. Extra Curricular Potential</p>
                            <input type="text" name="interview4" id="interview4" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center " required>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>5. Potential to support learning</p>
                            <input type="text" name="interview5" id="interview5" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center " required>
                        </div>
                        <div class="flex justify-end">
                            <h1 class="text-center w-[200px]" id="averageScore">Average Score:</h1>
                            <h1 id="averageScoreValue" class="w-[208px] border-2 border-[#D7D8D0] text-center"></h1>
                        </div>

                    </div>

                    <div class="mt-8 mx-8">
                        <table class="table-auto border border-solid border-black w-full">
                            <thead>
                                <tr class="justify-between">
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">5
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">4
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">3
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">2
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">1
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="justify-between">
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Excellent</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Very Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Less Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Limited Potential</td>
                                </tr>
                            </tbody>
                        </table>

                        <div>
                            <h1 class="font-poppins text-lg mt-8">Remarks</h1>
                        </div>
                        <div class="flex">
                            <textarea class="p-4 w-full border border-solid border-black text-left font-poppins" name="" id=""
                                cols="30" rows="5" style="resize: none;"></textarea>
                        </div>

                        <input type="text" hidden value="{{ $user->id }}" name="user_id">
                        <div class="flex justify-end mt-10 ">
                            <button id=""
                                class="font-bold text-white bg-[#2B6CE6] hover:bg-[#134197] rounded-[8px] font-poppins text-lg py-3 px-12 transition-colors duration-200"
                                type="submit">Submit</button>


                        </div>
                    </div>
            </form>

            <div class="relative my-2 mx-auto">
                @error('home_address')
                    <h1 class="bg-gray-200 p-3 text-[12px] rounded-md text-red-500 font-bold font-poppins">
                        {{ $message }}
                    </h1>
                @enderror

                @if (session('status'))
                    <div class="bg-gray-200 p-3 text-[12px] rounded-md text-green-500 font-bold font-poppins">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

    </div>

    </section>
    </div>


    <script>
        const inputDigits = document.querySelectorAll('.digit-only');

        inputDigits.forEach(element => {
            element.addEventListener("input", function(e) {
                e.target.value = e.target.value.replace(/[^0-9.]/g, '');
            })
        });



        const inputElements = document.querySelectorAll('.score');
        inputElements.forEach((inputElement) => {
            inputElement.addEventListener("input", function(e) {
                // Remove non-numeric characters from the input
                e.target.value = e.target.value.replace(/[^0-5]/g, '').substring(0, 1);;
                // Allows decimals as well
                calculateAverage();
            });
        });


        function calculateAverage() {
            // Get all input values, convert to numbers, and filter out any NaN values
            const values = Array.from(inputElements)
                .map((inputElement) => parseFloat(inputElement.value))
                .filter((value) => !isNaN(value));

            // Calculate the average
            const average = values.length > 0 ? values.reduce((a, b) => a + b) / values.length : 0;

            // Update the average score display
            const averageScoreValue = document.getElementById("averageScoreValue");
            averageScoreValue.textContent = average.toFixed(2); // Display with 2 decimal places
        }
    </script>
</body>

</html>
