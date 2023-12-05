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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    
    <script src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <div class="min-h-screen  bg-[#F7F7F7]">

        @include('layout.sidenav', ['active' => 0])
        <div class="ml-[218px] w-auto  text-black flex justify-between ">
            <div class="mt-4">
                <h1 class="text-[#1D489A] font-poppins font-medium text-[24px] mx-8">Welcome, Name Here👋</h1>
                <p class="text-[#718297] text-[12px] font-raleway font-normal mx-8 mb-4">Check your info here</p>
            </div>
        
            <div class="mt-4">
                <form class="w-[400px]" method="get" action="">
                    @csrf
        
                   
                    <div class="relative w-full">
                    <input type="text" name="searchTerm" placeholder="Search Here" class="px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-gray-500 bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    <i class='bx bx-category-alt bx-sm text-gray-500 bx-sm absolute right-3 top-1/2 transform -translate-y-1/2'></i>
                    </div>
                </form>
            </div>
            
            <div class="mt-6">
                <h1>{{ now()->format('F j, Y') }}</h1>
              
            </div>
        
            <div class="mt-6 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M19 13.586V10C19 6.783 16.815 4.073 13.855 3.258C13.562 2.52 12.846 2 12 2C11.154 2 10.438 2.52 10.145 3.258C7.185 4.074 5 6.783 5 10V13.586L3.293 15.293C3.19996 15.3857 3.12617 15.4959 3.07589 15.6172C3.0256 15.7386 2.99981 15.8687 3 16V18C3 18.2652 3.10536 18.5196 3.29289 18.7071C3.48043 18.8946 3.73478 19 4 19H20C20.2652 19 20.5196 18.8946 20.7071 18.7071C20.8946 18.5196 21 18.2652 21 18V16C21.0002 15.8687 20.9744 15.7386 20.9241 15.6172C20.8738 15.4959 20.8 15.3857 20.707 15.293L19 13.586ZM19 17H5V16.414L6.707 14.707C6.80004 14.6143 6.87383 14.5041 6.92412 14.3828C6.9744 14.2614 7.00019 14.1313 7 14V10C7 7.243 9.243 5 12 5C14.757 5 17 7.243 17 10V14C17 14.266 17.105 14.52 17.293 14.707L19 16.414V17ZM12 22C12.6193 22.0008 13.2235 21.8086 13.7285 21.4502C14.2335 21.0917 14.6143 20.5849 14.818 20H9.182C9.38566 20.5849 9.76648 21.0917 10.2715 21.4502C10.7765 21.8086 11.3807 22.0008 12 22Z"
                        fill="#626B7F" />
                    <circle cx="18" cy="8" r="4" fill="#EA3332" />
                </svg>
            </div>
        </div>


   
             


        <section class="ml-[218px] main">    
            <h1 class="text-[#26386A] font-bold text-lg px-4 py-2">Item Analysis</h1>
            <div class="bg-white mx-4  rounded-lg overflow-x-auto ">
                <div class="my-2 flex justify-evenly font-poppins text-[24px] font-bold text-[#26386A]">

                    <div>
                        <a href="">Sumary</a>
                    </div>

                    <div>
                        <a href="">Question</a>
                    </div>
                  
                    <div>
                        <a href="">Individual</a>
                    </div>
                
                </div>

                <div class="border-b-2 "></div>
            </div>

            <div class="bg-white mx-4 mt-4 rounded-lg overflow-x-auto ">
                <h1 class="text-[28px] px-4 py-4"><i class='bx bx-bar-chart-square' ></i> Insights</h1>
                <div class="border-b-2 "></div>
                <div class="flex justify-evenly my-4">
                    <div>
                        <h1><strong>Average</strong></h1>
                        <p>0 / 0 points</p>
                    </div>

                    <div>
                        <h1><strong>Median</strong></h1>
                        <p>0 / 0 points</p>
                    </div>

                    <div>
                        <h1><strong>Median</strong></h1>
                        <p>0 - 0 points</p>
                    </div>
                   
                </div>

                <div class=" text-center mx-auto my-6 h-[200px] w-[800px]" id="insight"></div>
                <script>
                    var options = {
                    chart: {
                        type: 'bar',
                        height: 280
                    },
                    series: [{
                        name: 'Respondents',
                        // data: [30,40,35,50,49,60,70,91,125]
                        data: [0,0,0,0,0, 1,40,2]
                    }],
                    xaxis: {
                        categories: [1,2,3,4,5,6,7,8,9,10]
                    },
                    colors : ['#264FDC'],
                    legend: {
                    show: true,
                    position: 'left', // You can change the position to 'bottom', 'right', or 'left'
                    horizontalAlign: 'center',
                    fontSize: '14px'
                    }
                    }
                   
        
                    var chart = new ApexCharts(document.querySelector("#insight"), options);
        
                    chart.render();
                </script>
            </div>

                

            {{-- <div class="bg-white mx-4 mt-4 rounded-t overflow-x-auto ">
                <div class="px-4  text-[18px] font-semibold font-poppins bg-[#2B6CE6] text-white">
                    <h1 class="py-2">Multiple Choices</h1> 
                </div>

                @foreach ($questions as $question)
                <div class="w-full " id="chart{{ $question->id }}"></div>
                <script>
                    var options{{ $question->id }} = {
                        chart: {
                            type: 'bar',
                            height: 250,
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 4,
                                horizontal: true,
                                barWidth: 40, // Set a fixed width for the bars (adjust as needed)
                            }
                        },
                        series: [
                            {
                                name: '{{ $question->content }}',
                                data: {!! json_encode($question->getResponseCounts()) !!}, // Replace with your method to get response counts
                            },
                        ],
                        xaxis: {
                            categories: {!! json_encode($question->getChoiceLabels()) !!}, // Replace with your method to get choice labels
                        },
                    };
        
                    var chart{{ $question->id }} = new ApexCharts(document.querySelector("#chart{{ $question->id }}"), options{{ $question->id }});
                    chart{{ $question->id }}.render();
                </script>
            @endforeach
            </div> --}}

            

        </section>

        
       
       
    </div>
   
</body>

</html>
