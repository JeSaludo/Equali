<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">Item </td>

            <td class="px-6 py-2 text-center">Difficulty Index</td>
            <td class="px-6 py-2 text-center">Difficulty</td>
            <td class="px-6 py-2 text-center">Discrimination Index</td>
            <td class="px-6 py-2 text-center">Discrimination</td>
            <td class="px-6 py-2">Action To Take</td>
            
        </tr>
    </thead>

    <tbody class="text-left ">         
                @foreach ($questions as $index => $question)
                    @if(isset($DI[$index]) && isset($DS[$index]))
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

                            <td class="px-6 py-3 text-center mx-auto">
                              
                                    @if($DS[$index] >= 0.86 )
                                        Very Easy
                                    @elseif ($DS[$index] <= 0.85 && $DS[$index] >= 0.71 )
                                        Easy
                                    @elseif ($DS[$index] <= 0.70 && $DS[$index] >= 0.30 )
                                        Moderate
                                    @elseif ($DS[$index] <= 0.29 && $DS[$index] >= 0.15 )
                                        Difficult
                                    @elseif ($DS[$index] <= 0.14 && $DS[$index] >= 0)
                                        Very Difficult
                                    @endif
                             
                            
                            </td>

                            <td class="px-6 py-3 text-center mx-auto">
                                {{ $DS[$index] }}
        
                                   
                            </td>

                            <td>
                               
                                    @if($DS[$index] >= 0.86 )
                                        To be discarded
                                    @elseif ($DS[$index] <= 0.85 && $DS[$index] >= 0.71 )
                                        To be revised
                                    @elseif ($DS[$index] <= 0.70 && $DS[$index] >= 0.30 )
                                        Very Good items
                                    @elseif ($DS[$index] <= 0.29 && $DS[$index] >= 0.15 )
                                        To be revised
                                    @elseif ($DS[$index] <= 0.14 && $DS[$index] >= 0)
                                        To be discarded
                                    @endif
                               
                            </td>

                            <td class="px-6 px-3">

                                @if($DS[$index] >= 0.86 )
                                Discard
                            @elseif ($DS[$index] <= 0.85 && $DS[$index] >= 0.71 )
                                Revise
                            @elseif ($DS[$index] <= 0.70 && $DS[$index] >= 0.30 )
                                Retain
                            @elseif ($DS[$index] <= 0.29 && $DS[$index] >= 0.15 )
                                Revise
                            @elseif ($DS[$index] <= 0.14 && $DS[$index] >= 0)
                                Discard
                            @endif

                            </td>

                        </tr>
                    @endif

                @endforeach

           
      
        
    </tbody>
</table>