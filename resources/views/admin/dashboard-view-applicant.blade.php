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


        <section class="ml-[218px] main ">
           
            <div>

                <div class="flex justify-evenly my-4">


                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                        <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Pending Applicants</h1>
    
    
                        <div class="flex items-end gap-3 text-[#718297] mb-8">
                            <i class='bx bxs-user-detail text-[45px] pb-2'></i>
                            <p class="text-[50px] py-0">{{ $recentUser->where('status', 'Pending')->count() }}</p>
                        </div>
    
                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>
    
                    </div>
    
                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                        <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">Approve Application</h1>
    
    
                        <div class="flex items-end gap-3 px-2 text-[#718297]">
                            <i class='bx bxs-user-check text-[45px] pb-2'></i>
                            <p class="text-[50px] py-0">{{ $recentUser->where('status', 'Approved')->count() + $recentUser->where('status', 'WaitListed')->count() }} </p>
                        </div>
                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>
    
    
                    </div>
    
                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                        <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">Archive Application</h1>
    
    
                        <div class="flex items-end gap-3 px-2 text-[#718297]">
                            <i class='bx bxs-archive-in text-[40px] pb-2'></i>
                            <p class="text-[50px] py-0">{{ $recentUser->where('status', 'Archived')->count() }}</p>
    
    
                        </div>
    
                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>
    
                    </div>
                </div>
            </div>

       
            <div class="bg-white mx-4 my-2  h-[600px] ">
               
                <div class="flex justify-between ">
                    <h1 class="text-[#26386A] font-bold text-xl uppercase  px-4 flex items-center" >List of Applicants</h1>
                    
                    <div class="flex items-center">
                        <form class="w-[400px]" method="get" action="{{route('admin.dashboard.show-applicant')}}">
                            @csrf
                
                           
                            <div class="relative w-full border-2 rounded-xl">
                            <input type="text" name="searchTerm" placeholder="Search Here" class="px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                            <i class='bx bx-search text-gray-500 bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                            <i class='bx bx-category-alt bx-sm text-gray-500 bx-sm absolute right-3 top-1/2 transform -translate-y-1/2'></i>
                            </div>
                        </form>
                    </div>

                    <div class="w-[140px]  mx-2 py-4">
                        <button id="addApplicantBtn"
                            class="px-2 py-2     w-full  rounded-[8px]  bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">
                            <div class="flex items-center justify-center"><i id="icon" class='bx bx-plus pr-1'></i><span class="text-[14px] font-poppins font-normal"> Add
                                Applicant</span></div>
                                </button>
                    </div>
                </div>
                
                @if ($errors->any())
                    <div class="text-red-900">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="applicantContent" class="app-content overflow-auto">
                    <table class="w-full  ">
                        <thead class="border-b-2 border-[#718297]">
                            <tr>
                                <th
                                    class="py-2
                        px-4 font-poppins text-[22px] text-[#26386A] uppercase">
                                    Applicant</th>
                                <th class="py-2 px-4 font-poppins text-[22px] whitespace-nowrap text-[#26386A]">
                                    Admission Score</th>
                                <th class="py-2 px-4 font-poppins text-[22px] text-[#26386A]">Status</th>
                                <th class="py-2 px-4 font-poppins text-[22px] text-[#26386A]">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center font-poppins text-[18px] w-full  ">
                            <div class="flex justify-between">
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
                                            class="{{ $index % 2 == 0 ? 'bg-[#aecafd30]' : 'bg-white' }} border-b-2 border-gray-100 ">
                                            <td class="px-3 py-2 w-4/12 whitespace-nowrap">
                                                {{ $user->last_name }}, {{ $user->first_name }}
                                            </td>
                                            @if ($user->admissionExam)
                                                <td class="px-3 py-2 w-2/12 text-center  whitespace-nowrap">
                                                    {{ $user->admissionExam->score }} /
                                                    {{ $user->admissionExam->total_score }}
                                                </td>
                                            @else
                                                No Admission Exam Score
                                            @endif

                                            <td class="px-3 py-2  whitespace-nowrap ">
                                                @if ($user->admissionExam->status === 'Failed')
                                                    <div
                                                        class="w-4/12  item-center mx-auto rounded-lg bg-[#FFC7C7] text-[#A25656] ">
                                                        <p class="py-1 ">Failed</p>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-4/12  item-center mx-auto rounded-lg bg-[#C7FFD7] text-[#56A26B]">
                                                        <p class="py-1">Passed</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td
                                                class="px-3 py-2 w-4/12 text-[#626B7F] mx-auto  flex justify-evenly gap-1 items-center ">



                                                {{-- <form action="{{ route('admin.dashboard.approve-applicant', $user->id) }}"
                                                method="POST" style="display: inline-block;">
                                                <button type="submit">
                                                    <i class='bx bx-user-check bx-sm hover:text-green-400'></button>

                                            </form> --}}

                                                <form
                                                    action="{{ route('admin.dashboard.approve-applicant', $user->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf

                                                    <button type="submit" title="Approve Applicant"
                                                        class="mx-2   hover:text-green-400"
                                                        onclick="return confirm('Are you sure you want to approve this user?')"><i
                                                            class='bx bx-user-check bx-sm'></i></button>

                                                </form>

                                                <form
                                                    action="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                    method="POST" style="display: inline-block;" >
                                                    @csrf

                                                    <button type="submit" title="Reject Applicant"
                                                        class="mx-2   hover:text-red-400"
                                                        onclick="return confirm('Are you sure you want to archive this user?')"><i
                                                            class='bx bx-user-x bx-sm'></i></button>

                                                </form>


                                                <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                    class="mx-1 hover:text-green-400" title="Edit"><i
                                                        class='bx bxs-edit '></i></a>

                                                <form
                                                    action="{{ route('admin.dashboard.delete-applicant', $user->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete"
                                                        class="mx-2   hover:text-red-400"
                                                        onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                            class='bx bxs-trash '></i></button>

                                                </form>






                                            </td>


                                        </tr>
                                    @endforeach
                                @endif
                            </div>
                        </tbody>

                    </table>
                </div>
            </div>
            
            <div class="">
                <div id="addApplicantContent"
                    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div>

                    </div>
                   
                    
                    <form action="{{ route('admin.dashboard.store-applicant') }}" method="POST">
                        @csrf
                        <div class="bg-white mx-auto text-center rounded-[12px] w-9/12 h-[380px] p-4 border-gray-600 border-2">
                            <div
                                class="relative text-center mx-auto font-poppins text-[28px] font-semibold  text-[#26386A] uppercase">
                                <h1>Add Applicant</h1>
                                <button id="closePopup" class="absolute top-0 right-0"><i class='bx bx-x bx-sm text-[#26386A]'></i></button>
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

    <script src="{{ asset('js/add-applicant.js') }}"></script>
</body>

</html>
