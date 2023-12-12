<div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg my-4">
    <div class="overflow-x-auto overflow-y-auto h-[350px]">
        <table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
            <thead class="border-b  text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
                <tr>
                    <td class="px-6 py-2">Item </td>
                    <td class="px-6 py-2 text-center">Difficulty Index</td>
                    <td class="px-6 py-2 text-center">Difficulty Level</td>

                    <td class="px-6 py-2 text-center">Status</td>
                    <td class="px-6 py-2">Action </td>

                </tr>
            </thead>

            <tbody class="text-left ">

                @php
                    $dataFound = false;
                @endphp

                @if ($questions->count() == 0)
                    <tr>
                        <td class="px-6 py-3">
                            <p>No data found in the database</p>
                        </td>
                    </tr>
                @else
                    @foreach ($questions as $index => $question)
                        @if (isset($DI[$index]))
                            @php
                                $dataFound = true;
                            @endphp

                            <tr
                                class="text-center mx-auto {{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                <td class="px-6 py-3">
                                    {{ $question->id }}

                                </td>

                                <td class="px-6 py-3">

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
                                        <a href="{{ route('admin.item-analysis.revise', $question->id) }}"
                                            onclick="return confirm('Are you sure you want to revise?')"
                                            class="text-[14px] py-1 px-6 rounded-md bg-orange-200 text-orange-700">Revise
                                        </a>
                                    @elseif ($DI[$index] > 0.29 && $DI[$index] < 0.71)
                                        <p class=" py-1 px-2 ">Retain</p>
                                    @elseif ($DI[$index] > 0.7 && $DI[$index] < 0.86)
                                        <a href="{{ route('admin.item-analysis.revise', $question->id) }}"
                                            onclick="return confirm('Are you sure you want to revise?')"
                                            class="text-[14px] py-1 px-6 rounded-md bg-orange-200 text-orange-700">Revise
                                        </a>
                                    @elseif ($DI[$index] > 0.85)
                                        <p class=" py-1 px-2 ">Discard</p>
                                    @endif



                                </td>

                            </tr>
                        @endif
                    @endforeach

                    @if (!$dataFound)
                        <tr class="">
                            <td></td>
                            <td class="py-2">
                                <p class="">No valid data found </p>
                            </td>

                        </tr>
                    @endif
                @endif

            </tbody>
        </table>
        <nav
            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">



        </nav>

    </div>

</div>
