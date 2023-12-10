<div class="flex-row md:flex justify-evenly my-4 ">

    <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


        <div class="flex items-end gap-3 text-[#718297] mb-8">
            <i class='bx bxs-user-detail text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">{{ $userCount->where('role', 'Student')->count() }}</p>
        </div>

        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
        </div>

    </div>
    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Schedule</h1>


        <div class="flex items-end gap-3 px-2 text-[#718297] ">
            <i class='bx bxs-user-check text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">
                {{ $userCount->where('role', 'Student')->where('status', 'Pending Schedule')->count() }}
            </p>

        </div>
        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
        </div>


    </div>





    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Interviews</h1>


        <div class="flex items-end gap-3 px-2 text-[#718297]">
            <i class='bx bxs-archive-in text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">
                {{ $userCount->where('role', 'Student')->where('status', 'Pending Interview')->count() }}
            </p>


        </div>

        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
        </div>

    </div>
</div>
