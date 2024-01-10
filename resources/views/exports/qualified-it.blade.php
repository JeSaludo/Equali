<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
        <tr>
            <td class="px-6 py-3">Rank</td>
            <td class="px-6 py-3">Applicant Name</td>
            <td class="px-6 py-3">Interview Result</td>
            <td class="px-6 py-3">Admission Results</td>
            <td class="px-6 py-3">Qualifying Results</td>
            <td class="px-6 py-3">Weighted Average</td>
        </tr>
    </thead>

    <tbody class="text-center ">
        @foreach ($users as $index => $user)
            <tr class=" border-b border-gray-100">
                <td class="px-6 py-3">{{ $index + 1 }}</td>
                <td class="px-6 py-3  whitespace-nowrap">{{ $user->last_name }},
                    {{ $user->first_name }}</td>
                <td class="px-6 py-3  whitespace-nowrap">
                    <p class="font-medium font-poppins  text-[#617388]">
                        @if (empty($user->measure_a_score))
                            N/A
                        @else
                            {{ $user->measure_a_score }}
                        @endif
                    </p>
                </td>
                <td class="px-6 py-3  whitespace-nowrap">
                    <p class="font-medium font-poppins text-[#617388]">
                        @if (empty($user->measure_b_score))
                            N/A
                        @else
                            {{ $user->measure_b_score }}
                        @endif
                    </p>
                </td>
                <td class="px-6 py-3  whitespace-nowrap">
                    <p class="font-medium font-poppins text-[#617388]">
                        @if (empty($user->measure_c_score))
                            N/A
                        @else
                            {{ $user->measure_c_score }}
                        @endif
                    </p>
                </td>
                <td class="px-6 py-3  whitespace-nowrap">
                    <p class="font-medium font-poppins text-[#617388]">
                        @if ($user->weighted_average)
                            {{ $user->weighted_average }}
                        @else
                            N/A
                        @endif
                    </p>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
