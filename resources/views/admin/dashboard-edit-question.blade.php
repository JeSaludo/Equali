<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Login </title>
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


        <aside class="fixed top-0 left-0 w-[218px] h-screen bg-white">
            <div class="mx-auto text-center py-2  ">
                <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.</h1>
                <div class="border-b-2 w-6/12 mx-auto"></div>
            </div>

            <div class="">
                <h2 class="font-raleway text-[14px] font-semibold text-[#718297] px-4 my-2 ">MAIN MENU</h2>

                <a href=""
                    class="mx-4 bg-gradient-to-r from-[#234BDA] to-[#6499FF] px-4 py-2 rounded-[15px] flex justify-between items-center text-white my-2">
                    <div class=""><i class='bx bxs-dashboard '></i> Overview </i></div>
                    <i class='bx bxs-circle'></i>
                </a>

                <nav class="relative">
                    <div class="dropdown" data-dropdown>


                        <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between items-center text-[#718297] my-2"
                            data-dropdown-button>
                            <div class="pointer-events-none"><i class='bx bxs-user pr-2'></i>Applicant</div><i
                                class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                        </a>

                        <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>
                            <a href="#WVSDA"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle pr-2 '></i>View
                                    Applicant
                                </div>
                            </a>

                            <a href="#WVSDA"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle pr-2 '></i>Add
                                    Applicant
                                </div>
                            </a>
                        </div>


                    </div>

                    <div class="dropdown" data-dropdown>

                        <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between items-center text-[#718297] my-2"
                            data-dropdown-button>
                            <div class="pointer-events-none"><i class='bx bxs-user pr-2'></i>User</div><i
                                class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                        </a>

                        <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>
                            <a href="#test"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle pr-2 '></i>View
                                    User
                                </div>
                            </a>

                            <a href="#test"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle pr-2 '></i>Add
                                    User
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown" data-dropdown>


                        <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between items-center text-[#718297] my-2"
                            data-dropdown-button>
                            <div class="pointer-events-none"><i class='bx bxs-user pr-2'></i>Question Bank</div><i
                                class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                        </a>

                        <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>
                            <a href="#test"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle pr-2 '></i>View
                                    Question
                                </div>
                            </a>

                            <a href="#test"
                                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex justify-between items-center text-[#718297] my-2">
                                <div class=""><i class='bx bx-radio-circle  pr-2 '></i>
                                    Add Question
                                </div>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>










        </aside>
        <div class="ml-[218px] w-auto  text-black flex justify-between ">
            <div class="my-4">
                <h1 class="text-[#1D489A] font-poppins font-medium text-[24px] mx-8">Welcome, Name Here👋</h1>
                <p class="text-[#718297] text-[12px] font-raleway font-normal mx-8 mb-4"> Question Bank </p>
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


        <section class="ml-[218px] ">
            <form action="{{ route('admin.dashboard.update-question', $question) }}" method="POST">
                @csrf
                @method('put')
                <div class="bg-white mx-4 rounded-[12px]  h-[587px] p-4">
                    <div class="bg-[#4c4a67] h-[163px]  rounded-[8px] ">
                        <input type="text"
                            class="bg-transparent text-[28px] mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                            placeholder="Type Question Here" name="question_text"
                            value="{{ $question->question_text }}" required>
                    </div>

                    <div>
                        <div class="h-[163px] my-7 flex justify-evenly gap-4 ">
                            @foreach ($question->choices as $key => $choice)
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Question Here" name="choice_text[]"
                                        value="{{ $choice->choice_text }}" required>

                                    <input
                                        class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 "
                                        type="radio" id="choice" name="correct_choice"
                                        value="{{ $key + 1 }}" @if ($choice->is_correct) checked @endif />
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-end w-full">


                            <div class="w-2/12 mb-8">
                                <input type="submit" value="Save Question"
                                    class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">

                            </div>


                        </div>


                    </div>

            </form>
            @if ($errors->any())
                <div class="text-red-900 ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-gray-200 p-3 text-[12px] rounded-md text-green-500 font-bold font-poppins">
                    {{ session('success') }}
                </div>
            @endif





        </section>

    </div>
    <script src="{{ asset('js/dropdown.js') }}"></script>
</body>

</html>
