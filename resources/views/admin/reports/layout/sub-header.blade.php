<div class="flex-row md:flex justify-evenly my-4 ">

    <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Retain Items</h1>


        <div class="flex items-end gap-3 text-[#718297] mb-8">
            <i class='bx bxs-user-detail text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">{{ $questionCount->where('category', 'Retain')->count() }} </p>
        </div>

        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

    </div>
    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Revise Items</h1>


        <div class="flex items-end gap-3 px-2 text-[#718297] mb-8 ">
            <i class='bx bxs-user-check text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">{{ $questionCount->where('category', 'Revise')->count() }} </p>
        </div>
        <div class="bg-[#5587F7] w-full   h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>


    </div>



    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Discarded Items</h1>


        <div class="flex items-end gap-3 px-2 text-[#718297] ">
            <i class='bx bxs-archive-in text-[30px] pb-2'></i>
            <p class="text-[36px] py-0">{{ $questionCount->where('category', 'Discard')->count() }}</p>


        </div>

        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

    </div>
</div>


<div class="flex justify-between mx-4 my-2">

    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway">Item Analysis</h1>
    <div>
        <a href="{{ route('admin.item-analysis-analyze') }}"
            class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
            Analyze
        </a>


    </div>






</div>
