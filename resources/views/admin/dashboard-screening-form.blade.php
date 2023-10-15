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


        @include('layout.sidenav');
        <div class="ml-[218px] w-auto  text-black flex justify-between ">
            <div class="my-4">
                <h1 class="text-[#1D489A] font-poppins font-medium text-[24px] mx-8">Welcome, Name Here👋</h1>
                <p class="text-[#718297] text-[12px] font-raleway font-normal mx-8 mb-4">Check your info here</p>
            </div>

            <div class="my-4 "><!--need to rework this-->
                <form class="w-[400px] ">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 pl-10 h-[47px] text-sm text-gray-900 border border-gray-300 rounded-lg bg-white "
                            placeholder="Search " required>
                        <button type="submit"
                            class="text-white absolute right-1.5 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div>

            <div class="my-6">
                <h1>September 9, 2023</h1>
            </div>

            <div class="my-6 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M19 13.586V10C19 6.783 16.815 4.073 13.855 3.258C13.562 2.52 12.846 2 12 2C11.154 2 10.438 2.52 10.145 3.258C7.185 4.074 5 6.783 5 10V13.586L3.293 15.293C3.19996 15.3857 3.12617 15.4959 3.07589 15.6172C3.0256 15.7386 2.99981 15.8687 3 16V18C3 18.2652 3.10536 18.5196 3.29289 18.7071C3.48043 18.8946 3.73478 19 4 19H20C20.2652 19 20.5196 18.8946 20.7071 18.7071C20.8946 18.5196 21 18.2652 21 18V16C21.0002 15.8687 20.9744 15.7386 20.9241 15.6172C20.8738 15.4959 20.8 15.3857 20.707 15.293L19 13.586ZM19 17H5V16.414L6.707 14.707C6.80004 14.6143 6.87383 14.5041 6.92412 14.3828C6.9744 14.2614 7.00019 14.1313 7 14V10C7 7.243 9.243 5 12 5C14.757 5 17 7.243 17 10V14C17 14.266 17.105 14.52 17.293 14.707L19 16.414V17ZM12 22C12.6193 22.0008 13.2235 21.8086 13.7285 21.4502C14.2335 21.0917 14.6143 20.5849 14.818 20H9.182C9.38566 20.5849 9.76648 21.0917 10.2715 21.4502C10.7765 21.8086 11.3807 22.0008 12 22Z"
                        fill="#626B7F" />
                    <circle cx="18" cy="8" r="4" fill="#EA3332" />
                </svg>
            </div>

        </div>


        <section class="ml-[218px] main ">
            <div class="bg-white mx-4 rounded-[12px]  mb-2 p-4">
                <h1 class="text-center text-[#26386A] font-poppins font-bold text-2xl my-3">Screening Form</h1>
                <div>
                    <form class="mx-10">
                        <div class="flex mt-10">
                            <input class="pl-8 pr-80 border-2 py-2 rounded-[10px]" type="text"
                                placeholder="Applicant Name:">
                            <input class="border-2 rounded-[10px] py-2 pl-8 ml-12 w-full" type="date"
                                placeholder="Date:">
                        </div>
                        <div class="flex mt-4">
                            <input class="pl-8 pr-80 border-2 py-2 rounded-[10px]" type="text"
                                placeholder="Home Address:">
                            <select class="border-2 rounded-[10px] py-2 pl-8 ml-12 w-full" name="">
                                <option value="" disabled selected>Course Applied:</option>
                                <option value="">Bachelor in Science of Information Technology</option>
                                <option value="">Bachelor in Science of Information Systems</option>
                            </select>
                        </div>
                        <div class="flex mt-16">
                            <input class="pl-8 pr-80 border-2 py-2 rounded-[10px]" type="text"
                                placeholder="School Attended:">
                            <input class="py-2 pl-8 border-2 rounded-[10px] ml-12 w-full" type="text"
                                placeholder="School Address:">
                        </div>
                        <div class="flex mt-4">
                            <input class="pl-8 pr-80 border-2 py-2 rounded-[10px]" type="text"
                                placeholder="Year Graduated:">
                            <input class="border-2 rounded-[10px] py-2 pl-8 ml-12 w-full" type="text"
                                placeholder="GWA:">
                        </div>
                        <div class="flex mt-4">
                            <select class="pl-8 pr-[118px] border-2 py-2 rounded-[10px]" name="">
                                <option value="" disabled selected>Academic Track:</option>
                                <option value="">Accountancy, Business, and Management </option>
                                <option value="">Humanities and Social Sciences</option>
                                <option value="">Science, Technology, Engineering, and Mathematics</option>
                                <option value="">General Academic Strand</option>
                                <option value="">Technical Vocational Livelihood (TVL) Track</option>
                                <option value="">Sports Track</option>
                                <option value="">Arts and Design Track</option>
                            </select>
                            <input class="py-2 pl-8 border-2 rounded-[10px] ml-12 w-full" type="text"
                                placeholder="Others:">
                        </div>
                        <div class="flex mt-2">
                            <h2 class="ml-2 font-poppins text-[#4E4E4E] opacity-50">Do you have any of Following:</h2>
                        </div>
                        <div class="flex ml-6 gap-32">
                            <h2>Computer:</h2>
                            <h2>Mobile Devices:</h2>
                            <h2>Status of Internet Connectivity:</h2>
                        </div>
                        <div class="flex-auto ml-6">
                            <input class="" type="checkbox">
                            <label class="pr-[124px]" for="desktop">Desktop</label>
                            <input class="" type="checkbox">
                            <label class="pr-[128px]" for="smartphone">Smartphone</label>
                            <input class="" type="checkbox">
                            <label class="" for="stable">Stable</label>
                        </div>
                        <div class="flex-auto ml-6">
                            <input class="" type="checkbox">
                            <label class="pr-[133px]" for="laptop">Laptop</label>
                            <input class="" type="checkbox">
                            <label class="pr-[173px]" for="tablet">Tablet</label>
                            <input class="" type="checkbox">
                            <label class="" for="unstable">Unstable</label>
                        </div>
                        <div class="flex-auto ml-6">
                            <input class="ml-[440px]" type="checkbox">
                            <label class="" for="none">None</label>
                        </div>
                        <div class="flex mt-8">
                            <h2 class="font-poppins mr-96 text-xl">Interview Guide:</h2>
                            <h2 class="font-poppins ml-80 text-xl">Score</h2>
                        </div>
                        <div class="flex mt-8">
                            <h3 class="font-poppins mr-96">1. Background and Interest to the program</h3>
                            <input class="border-2 rounded-[4px] ml-[75px] text-center" type="text"
                                placeholder="">
                        </div>
                        <div class="flex mt-8">
                            <h3 class="font-poppins mr-96">2. Ability to express one self</h3>
                            <input class="border-2 rounded-[4px] ml-[194px] text-center" type="text"
                                placeholder="">
                        </div>
                        <div class="flex mt-8">
                            <h3 class="font-poppins mr-96">3. Academic Potential</h3>
                            <input class="border-2 rounded-[4px] ml-[237px] text-center" type="text"
                                placeholder="">
                        </div>
                        <div class="flex mt-8">
                            <h3 class="font-poppins mr-96">4. Extra Curricular Potential</h3>
                            <input class="border-2 rounded-[4px] ml-[197px] text-center" type="text"
                                placeholder="">
                        </div>
                        <div class="flex mt-8">
                            <h3 class="font-poppins mr-96">5. Potential to support Learning</h3>
                            <input class="border-2 rounded-[4px] ml-[163px] text-center" type="text"
                                placeholder="">
                        </div>
                        <div class="mt-8">
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
                        </div>
                        <div>
                            <h1 class="font-poppins text-lg mt-8">Remarks</h1>
                        </div>
                        <div class="flex">
                            <textarea class="p-4 w-full border border-solid border-black text-left font-poppins" name="" id=""
                                cols="30" rows="10" style="resize: none;"></textarea>
                        </div>
                        <div class="flex justify-end mt-10 ">
                            <button id=""
                                class="font-bold text-white bg-[#2B6CE6] hover:bg-[#134197] rounded-[8px] font-poppins text-lg py-3 px-12 transition-colors duration-200"
                                type="button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
