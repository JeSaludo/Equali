<div class="my-4 text-left rtl:text-right bg-white mx-4 h-[385px]  border   border-[#D9DBE3]  shadow-md rounded-lg">
    <div class="overflow-x-auto ">
        <table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
            <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold  whitespace-nowrap">
                <tr>
                    <td class="px-6 py-2">ID</td>
                    <td class="px-6 py-2">Applicant Name</td>
                    <td class="px-6 py-2">Date Created</td>
                    <td class="px-6 py-2">Status</td>

                </tr>
            </thead>

            <tbody class="text-md">
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
                            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }}  border-b   border-gray-100 text-left ">

                            <td class="px-6 py-3 text-sm">{{ $user->id }}</td>
                            <td class="px-6 py-3">
                                <p class="font-medium font-poppins text-[#617388]">
                                    {{ $user->last_name }}, {{ $user->first_name }}</p>
                                <p class="text-[12px] font-poppins text-[#8898AC]">
                                    {{ $user->email }}
                            </td>
                            <td class="px-6 py-3">{{ $user->created_at }}</td>
                            <td class="px-6 py-3">


                                @if ($user->status == 'WaitListed')
                                    <span
                                        class="bg-sky-200  text-[14px] text-sky-700 py-1 px-2 rounded-md ">Waitlisted</span>
                                @elseif($user->status == 'Qualified')
                                    <span
                                        class="bg-blue-200  text-[14px] text-blue-700 py-1 px-2 rounded-md ">Qualified</span>
                                @elseif($user->status == 'Pending Interview')
                                    <span
                                        class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Pending
                                        Interview</span>
                                @elseif($user->status == 'Ready For Exam')
                                    <span
                                        class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Ready
                                        for Exam</span>
                                @elseif($user->status == 'Pending Schedule')
                                    <span class="bg-amber-200  text-[14px] text-amber-700 py-1 px-2 rounded-md ">Pending
                                        Schedule</span>
                                @elseif($user->status == 'Unqualified')
                                    <span
                                        class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Unqualified</span>
                                @elseif($user->status == 'Archived')
                                    <span
                                        class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Archived</span>
                                @elseif($user->status == 'Pending')
                                    <span
                                        class="bg-orange-200  text-[14px] text-orange-700 py-1 px-2 rounded-md ">Pending</span>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>


    </div>

</div>
