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
            @include('layout.danger-alert')
            @include('layout.sidenav', ['active' => 0])

            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Reports </h1>


                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="flex  mx-4 mt-1 justify-between items-center">
                    <h1 class="text-[#26386A] mx-4 font-bold text-xl  py-2">Item Analysis</h1>
                </div>


                <div class="flex mx-4 mb-4" id="navLinks">

                    <a href="{{ route('admin.dashboard.item-analysis-chart') }}"
                        class="font-poppins active  text-slate-500  nav-link whitespace-nowrap">Question Chart</a>
                    <a href="{{ route('admin.dashboard.item-analysis-report') }}"
                        class="font-poppins  text-slate-500 nav-link   whitespace-nowrap">Summary</a>


                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>







                @foreach ($questions as $question)
                    <div class="bg-white my-5 mx-4 rounded-lg border-[#D9DBE3] border">

                        <div class="px-4 mt-4 text-lg font-poppins font-bold">
                            <h1 class="text-[#26386A]">Question {{ $question->id }}</h1>
                        </div>
                        <div class="w-full px-8 py-4  " id="chart{{ $question->id }}"></div>
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
                                series: [{
                                    name: '{{ $question->content }}',
                                    data: {!! json_encode($question->getResponseCounts()) !!}, // Replace with your method to get response counts
                                }, ],
                                xaxis: {
                                    categories: {!! json_encode($question->getChoiceLabels()) !!}, // Replace with your method to get choice labels
                                },
                            };

                            var chart{{ $question->id }} = new ApexCharts(document.querySelector("#chart{{ $question->id }}"),
                                options{{ $question->id }});
                            chart{{ $question->id }}.render();
                        </script>
                    </div>
                @endforeach
        </div>



        </section>




        </div>

    </body>

</html>
