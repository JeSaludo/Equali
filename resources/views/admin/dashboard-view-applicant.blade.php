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
                    <form method="get" action="{{ route('admin.dashboard.show-applicant') }}"
                        class="relative w-[300px]">
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


                @include('layout.applicant-count', ['recentUser' => $recentUser])
                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Applicants</h1>



                    <div>
                        <button id="addApplicantBtn"
                            class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                            <i id="icon" class='bx bx-plus pr-1'></i>Add Applicant
                        </button>
                    </div>
                </div>


                <div class="flex mx-4 my-4" id="navLinks">
                    <a href="{{ route('admin.dashboard.show-applicant') }}"
                        class="font-poppins  text-slate-500 nav-link active ">All</a>
                    <a href="{{ route('admin.dashboard.show-pending-applicant') }}"
                        class="font-poppins  text-slate-500 nav-link ">Pending</a>
                    <a href="{{ route('admin.dashboard.show-approved-applicant') }}"
                        class="font-poppins  text-slate-500 nav-link">Approved</a>
                    <a href="{{ route('admin.dashboard.show-archive-applicant') }}"
                        class="font-poppins  text-slate-500 nav-link">Archived</a>

                    {{-- <a href="{{ route('admin.dashboard.show-waitlisted-applicant') }}"
                    class="font-poppins  text-slate-500 nav-link ">Waitlisted</a>
                <a href="{{ route('admin.dashboard.show-qualified-applicant') }}"
                    class="font-poppins  text-slate-500 nav-link ">Qualified</a>
                <a href="{{ route('admin.dashboard.show-unqualified-applicant') }}"
                    class="font-poppins  text-slate-500 nav-link ">Unqualified</a> --}}

                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>


                @include('layout.admission-table', ['users' => $users])



                <div class="">
                    <div id="addApplicantContent"
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">



                        <form action="{{ route('admin.dashboard.store-applicant') }}" method="POST">
                            @csrf
                            <div
                                class="bg-white mx-auto text-center rounded-[12px] w-[520px] h-[380px] p-4 border   border-[#D9DBE3]  ">
                                <div
                                    class="relative text-center mx-auto font-poppins text-[24px] font-semibold  text-[#26386A] uppercase">
                                    <h1>Add Applicant</h1>
                                    <button id="closePopup" class="absolute top-0 right-0"><i
                                            class='bx bx-x bx-sm text-[#26386A]'></i></button>
                                </div>

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
                                    <div class="relative  w-full">
                                        <input type="number" name="score"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="Score" required autocomplete="off">

                                    </div>


                                    <div class="relative  w-full">
                                        <input type="number" name="totalScore"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="Full Score" required autocomplete="off" value=60>
                                        {{-- Change for auto  --}}
                                    </div>
                                </div>
                                <div class="px-8 my-6">
                                    <input type="submit" value="Submit"
                                        class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>

                            </div>



                        </form>

                    </div>
                </div>

            </section>

        </div>

        <script src="{{ asset('js/nav-link.js') }}"></script>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
