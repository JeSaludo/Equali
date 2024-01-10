<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">No.</td>
            <td class="px-6 py-2">Applicant Name</td>
            <td class="px-6 py-2">Exam Score</td>

            <td class="px-6 py-2">Status</td>

        </tr>
    </thead>

    <tbody class="text-center ">
        @if ($users->count() == 0)
            <td></td>
            <td class="px-6 py-3">No Data found in the database</td>
        @else
            @foreach ($users as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                    <td class="px-6 py-3">
                        {{ $user->last_name . ', ' . $user->first_name }}
                    </td>

                    <td class="px-6 py-3">{{ $user->total_exam_score }} /
                        {{ $option->qualifying_number_of_items }}</td>


                    @if ($user->total_exam_score > $option->qualifying_passing_score)
                        <td class="px-6 py-3 ">
                            <p class="w-[80px] text-center mx-auto rounded-md bg-green-300 text-green-800">
                                Passed</p>
                        </td>
                    @else
                        <td class="px-6 py-3 ">
                            <p class="w-[80px] text-center mx-auto rounded-md bg-red-300 text-red-800">
                                Failed</p>
                        </td>
                    @endif

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
