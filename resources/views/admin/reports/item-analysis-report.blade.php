<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Overview </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


</head>

<body>
    <div class="min-h-screen  bg-[#F7F7F7]">

        @include('layout.sidenav', ['active' => 0])
        
        <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

            <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Reports </h1>

            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
            </div>

        </nav>  
        
        


   
             


        <section class="ml-[218px] main">    
           
           
      
           <div class="flex  mx-4 mt-1 justify-between items-center">
                <h1 class="text-[#26386A] mx-4 font-bold text-xl  py-2">Item Analysis</h1>
                <a href="{{ route('export.item-analysis-result') }}"
                    class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                    Export Report 
                </a>
            </div>
            <div class="flex mx-4 mb-4" id="navLinks">

                <a href="{{route('admin.dashboard.item-analysis-chart')}}"
                class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Question Chart</a>
                <a href="{{route('admin.dashboard.item-analysis-report')}}"
                    class="font-poppins active text-slate-500 nav-link   whitespace-nowrap">Summary</a>
               
    
                <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
            </div>

           
           
            <div class="flex justify-between mx-4 my-2">

                
               
            
            
               
            </div>
           


            <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg my-4">                    
                <div class="overflow-x-auto overflow-y-auto">
                    <table id="item-analysis-table" class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                        <thead class="border-b  text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
                            <tr>
                                <td class="px-6 py-2">Item </td>
                                <td class="px-6 py-2 text-center">Difficulty Index</td>
                                <td class="px-6 py-2 text-center">Difficulty</td>
                                <td class="px-6 py-2 text-center">Discrimination Index</td>
                                <td class="px-6 py-2 text-center">Discrimination</td>
                                <td class="px-6 py-2">Status </td>
                               
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
                                        @if(isset($DI[$index]) && isset($DS[$index]))
                                            @php
                                                $dataFound = true; 
                                            @endphp

                                            <tr class="text-center mx-auto {{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100"> 
                                                <td class="px-6 py-3"> 
                                                    {{ $question->id }}

                                                </td>

                                                <td class="px-6 py-3">
                                                  
                                                            {{ $DI[$index] }}
                                                      
                                                        
                                                           
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                 
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

                                                <td class="px-6 py-3 ">
                                                    {{ $DS[$index] }}
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap ">  
                                                       
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

                                                

                                                <td class="px-6 py-3 text-center">


                                                    @if($DS[$index] >= 0.86 )
                                                    <p class=" py-1 px-2">Discard</p>
                                                @elseif ($DS[$index] <= 0.85 && $DS[$index] >= 0.71 )
                                                    <p class=" py-1 px-2 ">Revise</p>
                                                @elseif ($DS[$index] <= 0.70 && $DS[$index] >= 0.30 )
                                                    <p class=" py-1 px-2 ">Retain</p>
                                                @elseif ($DS[$index] <= 0.29 && $DS[$index] >= 0.15 )
                                                    <p class=" py-1 px-2 ">Revise</p>
                                                @elseif ($DS[$index] <= 0.14 && $DS[$index] >= 0)
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
                    <nav class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">
                       
                        <a href="{{ $questions->previousPageUrl() }}"  class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $questions->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                            <span class="">Previous</span>
                       
                          </a>
                        
                
                        
                       
                        <div class="flex">
                            @for ($i = 1; $i <= $questions->lastPage(); $i++)
                          
                                <a href="{{ $questions->url($i) }}" 
                                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $questions->currentPage() ? 'bg-slate-100' : '' }}">
                                   {{ $i }}
                                </a>
                            @endfor
                        </div>
                        <a href="{{ $questions->nextPageUrl() }}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $questions->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                            <span class="">Next</span>
                       
                          </a>
                     
                     
                        
                   </nav>   
                    
                </div>
               
            </div>

          
            
        </section>

    </div>
    
</body>

</html>



