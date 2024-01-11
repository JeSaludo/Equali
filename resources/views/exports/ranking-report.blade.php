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
        @if ($users->isEmpty())
            <tr>
                <td>

                <td class="px-6 py-3">No Data found in the database</td>
                </td>
            </tr>
        @else
            @php
                $lastIndex = null;
            @endphp

            @foreach ($users as $index => $user)
                @if ($index === 0 || $user->weighted_average !== $users[$index - 1]->weighted_average)
                    @php

                        $lastIndex = $index + 1;

                    @endphp
                @endif


                <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                    <td class="px-6 py-3">{{ $lastIndex }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">
                        {{ $user->first_name }},
                        {{ $user->last_name }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                        <p class="font-medium font-poppins text-[#617388]">
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

        @endif

    </tbody>
</table>
