<aside class="fixed top-0 left-0 w-[218px] h-screen bg-white border-r border-[#D9DBE3]">
    <div class="mx-auto text-center py-2  ">
        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.</h1>
        <div class="border-b-2 w-6/12 mx-auto"></div>
    </div>

    <div class="">
        <h2 class="font-raleway text-[14px] font-semibold text-[#718297] px-4 my-2 ">MAIN MENU</h2>



        <nav class="relative">



            <a href="{{ route('admin.dashboard.overview') }}"
                class="mx-4 {{ $active == 0 ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : 'hover:bg-[#EAF0FF] text-[#718297]' }} px-4 py-2 rounded-[15px] flex justify-between items-center  my-2">
                <div class=""><i class='bx bxs-dashboard '></i> Overview </i></div>
                <i class='bx bxs-circle {{ $active == 0 ? 'opacity-100' : 'opacity-0' }}'></i>

            </a>

            @if (Auth::user()->role === 'ProgramHead')
                <div>
                    <a href="{{ route('admin.dashboard.show-applicant') }}"
                        class="mx-4 cursor-pointer {{ $active == 1 ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : 'hover:bg-[#EAF0FF] text-[#718297]' }}  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                        <div class="pointer-events-none"><i class='bx bxs-user pr-2'></i>Admission</div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                        class="mx-4 cursor-pointer whitespace-nowrap {{ $active == 1 ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : 'hover:bg-[#EAF0FF] text-[#718297]' }}  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                        <div class="pointer-events-none "><i class='bx bxs-calendar pr-2'></i>Schedule Interview</div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.report.qualified-applicant-ranking') }}"
                        class=" mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2"
                        data-dropdown-button>
                        <div class="pointer-events-none"><i class='bx bxs-report pr-2'></i>Reports</div>

                    </a>
                </div>
            @elseif (Auth::user()->role === 'Proctor')
                <a href="{{ route('admin.dashboard.pending-interview') }}"
                    class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                    <div class="pointer-events-none"><i class='bx bxs-file-blank pr-2'></i>Interview</div>
                </a>

                <div>
                    <a href="{{ route('admin.report.interview-result') }}"
                        class=" mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2"
                        data-dropdown-button>
                        <div class="pointer-events-none"><i class='bx bxs-report pr-2'></i>Reports</div>

                    </a>
                </div>
            @elseif (Auth::user()->role === 'Dean')
                <div>
                    <a href="{{ route('admin.dashboard.show-exam') }}"
                        class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                        <div class="pointer-events-none"><i class='bx bx-file pr-2'></i>Exam</div>
                    </a>
                </div>

                <div>
                    <a href="{{ route('admin.dashboard.view-question') }}"
                        class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                        <div class="pointer-events-none"><i class='bx bxs-hdd pr-2'></i></i>Question Bank</div>
                    </a>
                </div>

                <div>
                    <a href="{{ route('admin.dashboard.item-analysis') }}"
                        class="mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2">
                        <div class="pointer-events-none"><i class='bx bxs-data pr-2'></i>Item Analysis</div>
                    </a>
                </div>

                <div class="dropdown" data-dropdown>

                    <a class="dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[15px] flex justify-between  items-center text-[#718297] my-2"
                        data-dropdown-button>
                        <div class="pointer-events-none"><i class='bx bxs-report pr-2'></i>Reports</div>
                        <i class='caret-icon pointer-events-none  bx bx-caret-right'></i>
                    </a>

                    <div class="dropdown-menu  pointer-events-none opacity-0 " data-dropdown-content>

                        <a href="{{ route('admin.report.qualified-applicant-ranking') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                            <div class="px-4 whitespace-nowrap">Qualified Ranking</div>

                        </a>
                        <a href="{{ route('admin.dashboard.item-analysis-chart') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                            <div class="px-4 whitespace-nowrap">Item Analysis
                            </div>
                        </a>


                        <a href="{{ route('admin.dashboard.report.qualifying-exam') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                            <div class="px-4 whitespace-nowrap"> Qualifying Exam</div>

                        </a>

                        <a href="{{ route('admin.reports.show.unqualified-applicants') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                            <div class="px-4 whitespace-nowrap"> Unqualified</div>

                        </a>

                        <a href="{{ route('admin.reports.show.qualified-applicants') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[15px] flex  items-center text-[#718297] my-2">
                            <div class="px-4 whitespace-nowrap"> Qualified</div>

                        </a>


                    </div>
            @endif


        </nav>


    </div>
    <script src="{{ asset('js/dropdown.js') }}"></script>

</aside>
