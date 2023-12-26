<div class="grid md:mx-2 grid-col md:grid-cols-3 gap-4 mt-4">

    <a href="{{ route('admin.dashboard.admission') }}">
        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[16px] pt-2 font-poppins font-bold text-[#26386A] ">Total Applicants</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8 ">
                <i class='bx bxs-user-detail text-[24px] pb-2'></i>
                <p class="text-[36px] py-0">{{ $totalUserCount }}</p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>


    </a>

    <a href="{{ route('admin.dashboard.admission.exam') }}">
        <div class="bg-white mx-4 px-6  relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">For Qualifying Exam</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8">
                <i class='bx bxs-file text-[30px] pb-2'></i>
                <p class="text-[36px] py-0">
                    {{ $forQualifyingExamCount }}</p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>
    </a>

    <a href="{{ route('admin.dashboard.admission.interview') }}">
        <div class="bg-white mx-4 px-6  relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">For Interview</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8">
                <i class='bx bx-file text-[30px] pb-2'></i>
                <p class="text-[36px] py-0">
                    {{ $forInterviewCount }}
                </p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>
    </a>


    <a href="{{ route('admin.dashboard.admission.qualified') }}">
        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Qualified</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8">
                <i class='bx bxs-user-check text-[30px] pb-2'></i>
                <p class="text-[36px] py-0">
                    {{ $forQualifiedCount }}</p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>
    </a>


    <a href="{{ route('admin.dashboard.admission.waitlisted') }}">
        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Waitlisted</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8">
                <i class='bx bx-timer text-[30px] pb-2'></i>
                <p class="text-[36px] py-0">
                    {{ $forWaitListedCount }}</p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>
    </a>

    <a href="{{ route('admin.dashboard.admission.unqualified') }}">
        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
            <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Not Qualified</h1>


            <div class="flex items-end gap-3 text-[#718297] mb-8">
                <i class='bx bxs-user-x text-[30px] pb-2'></i>
                <p class="text-[36px] py-0">
                    {{ $forUnqualifiedCount }}</p>
            </div>

            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
            </div>

        </div>
    </a>
</div>
