<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen opacity-0 sm:opacity-100 translate-x-[-260px] sm:translate-x-0 border-r border-[#D9DBE3] transition-transform ease-in-out delay-75 overflow-y-auto sm:overflow-y-hidden">
    <div class="mx-auto text-center py-2 relative ">
        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.</h1>
        <div class="border-b-2 w-6/12 mx-auto"></div>

        <button id="exitButton" class=" block sm:hidden absolute right-0 top-0 p-4"><i
                class='bx bx-x bx-sm text-gray-500'></i></i>
        </button>
    </div>


    @if (Auth::user()->role === 'Dean')
        <div class="mt-6">

            <div class="mt-4 mx-4">
                <p class=" font-raleway text-[12px] font-bold text-[#718297]">NAVIGATION</p>


                <div class="dropdown font-poppins" data-dropdown>

                    <a class=" dropdown-button  cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[8px] flex justify-between  items-center  my-2  ' }}"
                        data-dropdown-button>
                        <div
                            class="relative z-10  pointer-events-none {{ request()->routeIs('dashboard.overview') ? 'text-[#234BDA]' : 'text-[#718297]' }}">
                            <i class='bx bx-home pr-2'></i></i>Dashboard
                        </div>
                        <i class='caret-icon pointer-events-none  bx bx-caret-right text-[#718297] '></i>
                    </a>

                    <div class="  dropdown-menu  pointer-events-none opacity-0 transition-transform ease-in-out delay-75"
                        data-dropdown-content>

                        <a href="{{ route('dashboard.overview') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('dashboard.overview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 text-white' : '' }}">
                            <div class="px-4 whitespace-nowrap">Overview</div>
                        </a>

                        {{-- <a href="{{ route('admin.test1') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.test1') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                            <div class="px-4 whitespace-nowrap">Analytics
                            </div>
                        </a> --}}

                        <a href="{{ route('dashboard.recent') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('dashboard.recent') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                            <div class="px-4 whitespace-nowrap">Recent Activity
                            </div>
                        </a>


                    </div>
                </div>
            </div>


            <div class="mt-4 mx-4 ">

                <p class=" font-raleway text-[12px] font-bold text-[#718297]">MANAGEMENT</p>


                <a href="{{ route('dean.admission') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('dean.admission') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('dean.admission.exam') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('dean.admission.interview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('dean.admission.qualified') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('dean.admission.unqualified') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('dean.admission.waitlisted') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    ">
                    <div class=" whitespace-nowrap"><i class='bx bxs-user-detail pr-2'></i>Admission
                    </div>
                </a>

                <a href="{{ route('admin.dashboard.show-exam') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.dashboard.show-exam') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                    <div class=" whitespace-nowrap"><i class='bx bx-file pr-2'></i></i>Exam
                    </div>
                </a>

                <a href="{{ route('admin.dashboard.view-question') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.dashboard.view-question') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                    <div class=" whitespace-nowrap"><i class='bx bxs-hdd pr-2'></i></i>Question Bank
                    </div>
                </a>

                <a href="{{ route('admin.dashboard.item-analysis') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.dashboard.item-analysis') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                    <div class=" whitespace-nowrap"><i class='bx bxs-analyse pr-2'></i>Item Analysis
                    </div>
                </a>
            </div>


            <p class="mx-4 mt-4 font-raleway text-[12px] font-bold text-[#718297]">REPORT</p>


            <div class="dropdown font-poppins" data-dropdown>
                @php
                    $textColorClass = request()->routeIs('admin.report.qualified-applicant-ranking') || request()->routeIs('admin.report.qualified-applicant-ranking-it') || request()->routeIs('admin.report.qualified-applicant-ranking-is') ? 'text-[#234BDA]' : 'text-[#718297]';
                @endphp

                <a class=" dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[8px] flex justify-between  items-center  my-2  ' }}"
                    data-dropdown-button>
                    <div class="relative z-10 pointer-events-none   {{ $textColorClass }}">
                        Qualified Ranking
                    </div>


                    <i class='caret-icon pointer-events-none  bx bx-caret-right text-[#718297] '></i>
                </a>

                <div class="  dropdown-menu  pointer-events-none opacity-0 transition-transform ease-in-out delay-75"
                    data-dropdown-content>

                    <a href="{{ route('admin.report.qualified-applicant-ranking') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">All</div>
                    </a>

                    <a href="{{ route('admin.report.qualified-applicant-ranking-it') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking-it') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Qualified IT
                        </div>
                    </a>

                    <a href="{{ route('admin.report.qualified-applicant-ranking-is') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking-is') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Qualified IS
                        </div>
                    </a>


                </div>
            </div>

            <div class="dropdown font-poppins" data-dropdown>

                <a class=" dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[8px] flex justify-between  items-center  my-2  ' }}"
                    data-dropdown-button>
                    <div
                        class="relative z-10  pointer-events-none {{ request()->routeIs('admin.dashboard.item-analysis-report') ? 'text-[#234BDA]' : 'text-[#718297]' }} {{ request()->routeIs('admin.dashboard.item-analysis-chart') ? 'text-[#234BDA]' : 'text-[#718297]' }}">
                        Item Analysis
                    </div>
                    <i class='caret-icon pointer-events-none  bx bx-caret-right text-[#718297] '></i>
                </a>

                <div class="  dropdown-menu  pointer-events-none opacity-0 transition-transform ease-in-out delay-75"
                    data-dropdown-content>

                    <a href="{{ route('admin.dashboard.item-analysis-chart') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.dashboard.item-analysis-chart') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Responses</div>
                    </a>

                    <a href="{{ route('admin.dashboard.item-analysis-report') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.dashboard.item-analysis-report') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Item Summary
                        </div>
                    </a>




                </div>
            </div>

            <a href="{{ route('admin.dashboard.report.qualifying-exam') }}"
                class="mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.test1') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                <div class=" whitespace-nowrap"></i>Qualfying Exam
                </div>
            </a>

            <a href="{{ route('admin.reports.show.unqualified-applicants') }}"
                class="mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.test1') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                <div class=" whitespace-nowrap"></i>Qualified
                </div>
            </a>

            <a href="{{ route('admin.reports.show.qualified-applicants') }}"
                class="mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.test1') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                <div class=" whitespace-nowrap"></i>Unqualified
                </div>
            </a>

        </div>
    @elseif (Auth::user()->role === 'ProgramHead')
        <div class="mt-6">

            <div class="mt-4 mx-4">
                <p class=" font-raleway text-[12px] font-bold text-[#718297]">NAVIGATION</p>


                <div class="dropdown font-poppins" data-dropdown>

                    <a class=" dropdown-button  cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[8px] flex justify-between  items-center  my-2  ' }}"
                        data-dropdown-button>
                        <div
                            class="relative z-10  pointer-events-none {{ request()->routeIs('dashboard.overview') ? 'text-[#234BDA]' : 'text-[#718297] ?>' }}">
                            <i class='bx bx-home pr-2'></i></i>Dashboard
                        </div>
                        <i class='caret-icon pointer-events-none  bx bx-caret-right text-[#718297] '></i>
                    </a>

                    <div class="  dropdown-menu  pointer-events-none opacity-0 transition-transform ease-in-out delay-75"
                        data-dropdown-content>

                        <a href="{{ route('dashboard.overview') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('dashboard.overview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 text-white' : '' }}">
                            <div class="px-4 whitespace-nowrap">Overview</div>
                        </a>

                        {{-- <a href="{{ route('admin.test1') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.test1') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Analytics
                        </div>
                    </a> --}}

                        <a href="{{ route('dashboard.recent') }}"
                            class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('dashboard.recent') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                            <div class="px-4 whitespace-nowrap">Recent Activity
                            </div>
                        </a>


                    </div>
                </div>
            </div>


            <div class="mt-4 mx-4 ">

                <p class=" font-raleway text-[12px] font-bold text-[#718297]">MANAGEMENT</p>


                <a href="{{ route('programhead.admission') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('programhead.admission') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('programhead.admission.exam') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('programhead.admission.interview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('programhead.admission.qualified') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('programhead.admission.unqualified') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('programhead.admission.waitlisted') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    ">
                    <div class=" whitespace-nowrap"><i class='bx bxs-user-detail pr-2'></i>Admission
                    </div>
                </a>

            </div>

            <div class="mt-4 mx-4 ">



                <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                    class=" px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 
                    {{ request()->routeIs('admin.dashboard.show-schedule-interview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('admin.dashboard.show-scheduled-interview') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                    {{ request()->routeIs('admin.dashboard.show-scheduled-calendar') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}
                     ">
                    <div class=" whitespace-nowrap"><i class='bx bx-calendar-event pr-2'></i></i>Schedule Interview
                    </div>
                </a>

            </div>


            <p class="mx-4 mt-4 font-raleway text-[12px] font-bold text-[#718297]">REPORT</p>


            <div class="dropdown font-poppins" data-dropdown>
                @php
                    $textColorClass = request()->routeIs('admin.report.qualified-applicant-ranking') || request()->routeIs('admin.report.qualified-applicant-ranking-it') || request()->routeIs('admin.report.qualified-applicant-ranking-is') ? 'text-[#234BDA]' : 'text-[#718297]';
                @endphp
                <a class=" dropdown-button mx-4 cursor-pointer hover:bg-[#EAF0FF]  px-4 py-2 rounded-[8px] flex justify-between  items-center  my-2  ' }}"
                    data-dropdown-button>
                    <div class="relative z-10  pointer-events-none {{ $textColorClass }}">
                        <i class='bx bx-bar-chart-square pr-2'></i></i></i>Qualified Ranking
                    </div>
                    <i class='caret-icon pointer-events-none  bx bx-caret-right text-[#718297] '></i>
                </a>

                <div class="  dropdown-menu  pointer-events-none opacity-0 transition-transform ease-in-out delay-75"
                    data-dropdown-content>

                    <a href="{{ route('admin.report.qualified-applicant-ranking') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">All</div>
                    </a>

                    <a href="{{ route('admin.report.qualified-applicant-ranking-it') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking-it') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Qualified IT
                        </div>
                    </a>

                    <a href="{{ route('admin.report.qualified-applicant-ranking-is') }}"
                        class=" mx-4 px-4 py-2 hover:cursor-pointer hover:bg-[#EAF0FF] rounded-[8px] flex  items-center text-[#718297] my-2 {{ request()->routeIs('admin.report.qualified-applicant-ranking-is') ? 'bg-gradient-to-r from-[#234BDA] to-[#6499FF] text-white' : '' }}">
                        <div class="px-4 whitespace-nowrap">Qualified IS
                        </div>
                    </a>


                </div>
            </div>



        </div>
    @endif





</aside>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sidebar = document.getElementById("sidebar");
        var menuButton = document.getElementById("menuButton");
        var exitButton = document.getElementById("exitButton");

        // Toggle sidebar visibility
        function toggleSidebar() {
            sidebar.classList.toggle("translate-x-[-260px]");
            sidebar.classList.toggle("opacity-0");
            sidebar.classList.toggle('bg-white');
        }

        // Event listener for menu button
        menuButton.addEventListener("click", function(event) {
            event.preventDefault();
            console.log("Menu button clicked");
            toggleSidebar();
        });

        // Event listener for exit button
        exitButton.addEventListener("click", function(event) {
            event.preventDefault();
            console.log("Exit button clicked");
            toggleSidebar();
        });
    });
</script>


<script src="{{ asset('js/dropdown.js') }}"></script>
