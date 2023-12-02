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

            <div class="flex items-center  ">
                <form method="get" action="{{route('admin.dashboard.report.qualifying-exam')}}" class="relative w-[300px]">
                    @csrf
                    <input type="text" name="searchTerm" placeholder="Search Here"   value="{{ request('searchTerm') }}" class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    </form>
            </div>
        
            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]' ></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]' ></i>
            </div>
         
        </nav>    





        <section class="ml-[218px] main ">

            <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg my-4">                    
                <div class="overflow-x-auto">
                    <table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                        <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                            <tr>
                                <td class="px-6 py-2">Item </td>
                                <td class="px-6 py-2">Difficulty Index</td>
                                <td class="px-6 py-2">Discrimination Index</td>
                                <td class="px-6 py-2">Action</td>
                               
                            </tr>
                        </thead>
                
                        <tbody class="text-left "> 

                            @php
                                $dataFound = false; 
                            @endphp
                            @if ($questions->count() == 0)
                                <tr class="">
                                   
                                    <td class="px-6 py-3">
                                        <p>No data found in the database</p>
                                    </td>
                                   
                                </tr>
                            @else
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

                                            <tr> 
                                                <td class="px-6 py-3"> 
                                                    {{ $question->id }}

                                                </td>

                                                <td class="px-6 py-3">
                                                    <div class="flex">
                                                        <div class="w-6/12">
                                                            {{ $DI[$index] }}
                                                        </div>
                                                        <div class="w-6/12">
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
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-3">
                                                    <div class="flex">
                                                        <div class="w-6/12">
                                                            {{ $DS[$index] }}
                                                        </div>
                            
                                                        <div class="w-6/12">
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
                                                        </div>
                                                    </div>
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
                            @endif 
                         
                        </tbody>
                    </table>
                    {{-- <nav class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">
                       
                        <a href="{{ $users->previousPageUrl() }}"  class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                            <span class="">Previous</span>
                       
                          </a>
                        
                
                        
                       
                        <div class="flex">
                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                          
                                <a href="{{ $users->url($i) }}" 
                                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $users->currentPage() ? 'bg-slate-100' : '' }}">
                                   {{ $i }}
                                </a>
                            @endfor
                        </div>
                        <a href="{{ $users->nextPageUrl() }}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                            <span class="">Next</span>
                       
                          </a>
                        {{-- Next Page Link --}}
                     
                        
                    {{-- </nav>  --}}  
                    
                </div>
               
            </div>

            <div class="bg-white mx-4  rounded-lg  overflow-x-auto h-[380px] ">


                <table class="min-w-full  table-auto mx-auto text-center ">
                    <thead class="">
                        <tr class="border-b-2 border-[#617388] bg-slate-100 ">
                            <th
                                class="text-center px-6 py-4 text-xl font-poppins font-bold text-[#26386A] uppercase tracking-wider">
                                Item
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xl font-poppins font-bold  text-[#26386A] uppercase tracking-wider">
                                Difficulty Index</th>

                            <th
                                class="px-6 py-4 text-center text-xl font-poppins font-bold  text-[#26386A] uppercase tracking-wider">
                                Discrimination Index</th>
                            
                            <th
                                class="px-6 py-4 text-center text-xl font-poppins font-bold  text-[#26386A] uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $dataFound = false; // Initialize a flag to track if any valid data is found
                        @endphp
                    
                        @if ($questions->count() == 0)
                            <tr class="">
                                <td></td>
                                <td class="py-2">
                                    <p>No data found in the database</p>
                                </td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($questions as $index => $question)
                                @if(isset($DI[$index]) && isset($DS[$index]))
                                    @php
                                        $dataFound = true; // Set the flag to true when valid data is found
                                    @endphp
                    
                                    <tr class="">
                                        <td class="px-6 py-2  whitespace-nowrap">
                                            {{ $question->id }}
                                        </td>
                    
                                        <td class="text-center px-6 py-2 whitespace-nowrap font-poppins w-2/6 text-[#617388] ">
                                            <div class="flex">
                                                <div class="w-6/12">
                                                    {{ $DI[$index] }}
                                                </div>
                                                <div class="w-6/12">
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
                                                </div>
                                            </div>
                                        </td>
                    
                                        <td class="px-6 py-2 whitespace-nowrap font-poppins w-2/6 text-[#617388] text-center">
                                            <div class="flex">
                                                <div class="w-6/12">
                                                    {{ $DS[$index] }}
                                                </div>
                    
                                                <div class="w-6/12">
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
                                                </div>
                                            </div>
                                        </td>
                    
                                        <td class="px-6 py-2 whitespace-nowrap font-poppins w-full text-[#617388] text-center">
                                            <form action="">
                                                <button>
                                                    Revise
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    
                            {{-- Display "No data found" if the flag is still false --}}
                            @if (!$dataFound)
                                <tr class="">
                                    <td></td>
                                    <td class="py-2">
                                        <p>No valid data found</p>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
                <div>

                </div>
            </div>
            
            
        </section>

    </div>

</body>

</html>



