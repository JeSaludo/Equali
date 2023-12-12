<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">Item </td>
            <td class="px-6 py-2 text-center">Difficulty Index</td>
            <td class="px-6 py-2 text-center">Difficulty Level</td>
            <td class="px-6 py-2 text-center">Status</td>
            <td class="px-6 py-2">Action</td>

        </tr>
    </thead>

    <tbody class="text-left ">
        @foreach ($questions as $index => $question)
            @if (isset($DI[$index]))
                @php
                    $dataFound = true;
                @endphp

                <tr>
                    <td class="px-6 py-3">
                        {{ $question->id }}

                    </td>

                    <td class="px-6 py-3 text-center mx-auto">

                        {{ $DI[$index] }}


                    </td>

                    <td class="px-6 py-3 whitespace-nowrap">


                        @if ($DI[$index] < 0.15)
                            Very Difficult
                        @elseif ($DI[$index] > 0.14 && $DI[$index] < 0.3)
                            Difficult
                        @elseif ($DI[$index] > 0.29 && $DI[$index] < 0.71)
                            Moderate
                        @elseif ($DI[$index] > 0.7 && $DI[$index] < 0.86)
                            Easy
                        @elseif ($DI[$index] > 0.85)
                            Very Easy
                        @endif



                    </td>


                    <td class="px-6 py-3 whitespace-nowrap ">


                        @if ($DI[$index] < 0.15)
                            To be discarded
                        @elseif ($DI[$index] > 0.14 && $DI[$index] < 0.3)
                            To be revised
                        @elseif ($DI[$index] > 0.29 && $DI[$index] < 0.71)
                            Very Good Items
                        @elseif ($DI[$index] > 0.7 && $DI[$index] < 0.86)
                            To be revised
                        @elseif ($DI[$index] > 0.85)
                            To be discarded
                        @endif


                    </td>



                    <td class="px-6 py-3 text-center">
                        @if ($DI[$index] < 0.15)
                            <p class=" py-1 px-2">Discard</p>
                        @elseif ($DI[$index] > 0.14 && $DI[$index] < 0.3)
                            <p class=" py-1 px-2 ">Revise</p>
                        @elseif ($DI[$index] > 0.29 && $DI[$index] < 0.71)
                            <p class=" py-1 px-2 ">Retain</p>
                        @elseif ($DI[$index] > 0.7 && $DI[$index] < 0.86)
                            <p class=" py-1 px-2 ">Revise</p>
                        @elseif ($DI[$index] > 0.85)
                            <p class=" py-1 px-2 ">Discard</p>
                        @endif
                    </td>

                </tr>
            @endif
        @endforeach




    </tbody>
</table>
