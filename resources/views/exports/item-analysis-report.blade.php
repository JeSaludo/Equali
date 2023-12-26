<table id="item-analysis-table"
    class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b  text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">Item </td>
            <td class="px-6 py-2 text-center">Difficulty Index</td>
            <td class="px-6 py-2 text-center">Difficult Level</td>
            <td class="px-6 py-2 text-center">Status</td>
            <td class="px-6 py-2">Action </td>
            <td class="px-6 py-2">Analyzed Date </td>
        </tr>
    </thead>

    <tbody class="text-left ">

        @php
            $dataFound = false;
        @endphp

        @if ($items->count() == 0)
            <tr>
                <td class="px-6 py-3">
                    <p>No data found in the database</p>
                </td>
            </tr>
        @else
            @foreach ($items as $index => $item)
                <tr
                    class="text-center mx-auto {{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                    <td class="px-6 py-3">
                        {{ $item->id }}

                    </td>

                    <td class="px-6 py-3">

                        {{ $item->di }}



                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">


                        @if ($item->di < 0.15)
                            Very Difficult
                        @elseif ($item->di > 0.14 && $item->di < 0.3)
                            Difficult
                        @elseif ($item->di > 0.29 && $item->di < 0.71)
                            Moderate
                        @elseif ($item->di > 0.7 && $item->di < 0.86)
                            Easy
                        @elseif ($item->di > 0.85)
                            Very Easy
                        @endif



                    </td>


                    <td class="px-6 py-3 whitespace-nowrap ">


                        @if ($item->di < 0.15)
                            To be discarded
                        @elseif ($item->di > 0.14 && $item->di < 0.3)
                            To be revised
                        @elseif ($item->di > 0.29 && $item->di < 0.71)
                            Very Good Items
                        @elseif ($item->di > 0.7 && $item->di < 0.86)
                            To be revised
                        @elseif ($item->di > 0.85)
                            To be discarded
                        @endif


                    </td>



                    <td class="px-6 py-3 text-center">



                        @if ($item->di < 0.15)
                            <p class=" py-1 px-2">Discard</p>
                        @elseif ($item->di > 0.14 && $item->di < 0.3)
                            <p class=" py-1 px-2 ">Revise</p>
                        @elseif ($item->di > 0.29 && $item->di < 0.71)
                            <p class=" py-1 px-2 ">Retain</p>
                        @elseif ($item->di > 0.7 && $item->di < 0.86)
                            <p class=" py-1 px-2 ">Revise</p>
                        @elseif ($item->di > 0.85)
                            <p class=" py-1 px-2 ">Discard</p>
                        @endif
                    </td>


                    <td class="px-6 py-3 text-center">
                        {{ $item->year }}
                    </td>
                </tr>
            @endforeach


        @endif

    </tbody>
</table>
