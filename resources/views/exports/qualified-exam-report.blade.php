<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">ID</td>
            <td class="px-6 py-2">Applicant Name</td>
            <td class="px-6 py-2">Exam Score</td>
            <td class="px-6 py-2">Status</td>
        </tr>
    </thead>

    <tbody class="text-center ">
        @foreach ($results as $index => $result)
            <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                <td class="px-6 py-3">{{ $result->user_id }}</td>
                <td class="px-6 py-3">{{ $result->user->last_name . ', ' . $result->user->first_name }}</td>
                <td class="px-6 py-3">{{ $result->total_exam_score }}</td>
                @if ($result->total_exam_score > $option->qualifying_passing_score)
                    <td class="px-6 py-3">Passed</td>
                @else
                    <td class="px-6 py-3">Failed</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
