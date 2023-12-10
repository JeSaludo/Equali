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

          
            @include('layout.user-popup')
        </nav>
        <section class="ml-[218px] main ">

            @include('layout.popup')
            <div class="mx-4 my-4">

                <div class="flex justify-between mx-4 my-2">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway">List of Qualified Applicants
                    </h1>



                    <div>
                        <a href="{{ route('export.qualified-exam-result') }}"
                            class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                            Export Report
                        </a>
                    </div>
                </div>
                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
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
                                @if($results->count() == 0)
                                    <td></td>
                                    <td class="px-6 py-3">No data found in database</td>
                                @else
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

                                @endif


                                
                            </tbody>
                        </table>
                        <nav class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">
                       
                            <a href="{{ $results->previousPageUrl() }}"  class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $results->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Previous</span>
                        
                            </a>
                        
                
                        
                       
                            <div class="flex">
                                @for ($i = 1; $i <= $results->lastPage(); $i++)
                            
                                    <a href="{{ $results->url($i) }}" 
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $results->currentPage() ? 'bg-slate-100' : '' }}">
                                    {{ $i }}
                                    </a>
                                @endfor
                            </div>
                            <a href="{{ $results->nextPageUrl() }}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $results->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Next</span>
                        
                            </a>
                        </nav>    
                    </div>
        </section>
    </div>
</body>

</html>
