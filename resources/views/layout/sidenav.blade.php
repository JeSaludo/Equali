<aside class="fixed top-0 left-0 w-[218px] h-screen bg-white border-r border-[#D9DBE3]"> 
    <div class="mx-auto text-center py-2  ">
        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.</h1>
        <div class="border-b-2 w-6/12 mx-auto"></div>
    </div>

    <div class="">
        <h2 class="font-raleway text-[14px] font-semibold text-[#718297] px-4 my-2 ">MAIN MENU</h2>

        <a href="{{ route('admin.dashboard.overview') }}"
            class="mx-4 bg-gradient-to-r from-[#234BDA] to-[#6499FF] px-4 py-2 rounded-[15px] flex justify-between items-center text-white my-2">
            <div class=""><i class='bx bxs-dashboard '></i> Overview </i></div>
            <i class='bx bxs-circle'></i>
        </a>

        <nav class="relative">
            <div class="dropdown" data-dropdown>

                <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between items-center text-[#718297] my-2"
                    data-dropdown-button>
                    <div class="pointer-events-none"><i class='bx bxs-user pr-2'></i>Admission</div><i
                        class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                </a>

                <div class="dropdown-menu  pointer-events-none opacity-0 whitespace-nowrap " data-dropdown-content>
                    <a href="{{ route('admin.dashboard.show-applicant') }}"
                        class="mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap"> Pending </div>
                    </a>



                    <a href="{{route('admin.dashboard.show-archive-applicant')}}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap"> Archive </div>


                    </a>
                    <a href="{{ route('admin.dashboard.show-approved-applicant') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Approve</div>


                    </a>


                </div>


            </div>


           



            <div class="dropdown" data-dropdown>


                <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2"
                    data-dropdown-button>
                    <div class="pointer-events-none"><i class='bx bxs-file-blank pr-2'></i>Interview</div><i
                        class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                </a>

                <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>

                    <a href="{{ route('admin.dashboard.pending-interview') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Pending 
                        </div>
                    </a>
                    <a href="{{ route('admin.dashboard.show-qualified-appplicant') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">
                            Schedule 
                        </div>

                    </a>
                    

                    <a href="{{ route('admin.dashboard.show-review') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Review 
                        </div>
                    </a>

                </div>
            </div>


            <div>
                <a href="{{ route('admin.dashboard.show-exam') }}" class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                    <div class="pointer-events-none"><i class='bx bx-file pr-2'></i>Exam</div>
                </a>
            </div>

            <div>
                <a href="{{ route('admin.dashboard.view-question') }}" class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                    <div class="pointer-events-none"><i class='bx bxs-data pr-2'></i>Question Bank</div>
                </a>
            </div>
            
            

           
            <div class="dropdown" data-dropdown>


                <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2"
                    data-dropdown-button>
                    <div class="pointer-events-none"><i class='bx bxs-report pr-2'></i>Reports</div>
                    <i class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                </a>

                <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>

                    <a href="{{ route('admin.report.qualified-exam') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Weighted Average</div>

                    </a>
                    <a href="{{ route('admin.dashboard.item-analysis-chart') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Item Analysis
                        </div>
                    </a>

                    <a href="{{ route('admin.dashboard.report.qualifying-exam') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                        <div class="px-4 whitespace-nowrap">Qualifying Exam</div>

                    </a>

                    
                    

                </div>









        </nav>

        <div class="absolute bottom-0 left-0 w-full">
            <a href="{{ route('auth.logout') }}"
                class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                <div class=""><i class='bx bx-log-out pr-2'></i>Logout
                </div>
            </a>
        </div>
    </div>
    <script src="{{ asset('js/dropdown.js') }}"></script>

</aside>
