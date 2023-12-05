<table
class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
<thead
    class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
    <tr>
        <td class="px-6 py-2">ID</td>
        <td class="px-6 py-2">Applicant Name</td>
        <td class="px-6 py-2">Interview Result</td>
        <td class="px-6 py-2">Admission Results</td>
        <td class="px-6 py-2">Qualifying Results</td>
        <td class="px-6 py-2">Weighted Average</td>
    </tr>
</thead>

<tbody class="text-center ">
    @foreach ($results as $index => $result)
        <tr
            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
            <td class="px-6 py-2">{{$result->user->id}}</td>
            <td class="px-6 py-2  whitespace-nowrap">{{ $result->user->first_name }},
                {{ $result->user->last_name }}</td>
            <td class="px-6 py-2  whitespace-nowrap">
                <p class="font-medium font-poppins  text-[#617388]">
                    @if (empty($result->measure_a_score))
                        N/A
                    @else
                        {{ $result->measure_a_score }}
                    @endif
                </p>
            </td>
            <td class="px-6 py-2  whitespace-nowrap">
                <p class="font-medium font-poppins text-[#617388]">
                    @if (empty($result->measure_b_score))
                        N/A
                    @else
                        {{ $result->measure_b_score }}
                    @endif
                </p>
            </td>
            <td class="px-6 py-2  whitespace-nowrap">
                <p class="font-medium font-poppins text-[#617388]">
                    @if (empty($result->measure_c_score))
                        N/A
                    @else
                        {{ $result->measure_c_score }}
                    @endif
                </p>
            </td>
            <td class="px-6 py-2  whitespace-nowrap">
                <p class="font-medium font-poppins text-[#617388]">
                    @if ($result->weighted_average)
                        {{ $result->weighted_average }}
                    @else
                        N/A
                    @endif
                </p>
            </td>
        </tr>
    @endforeach

</tbody>
</table>