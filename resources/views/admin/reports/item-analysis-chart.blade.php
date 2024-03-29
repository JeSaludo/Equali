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
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    fontFamily: {
                        open: '"Open Sans"',
                        poppins: "'Poppins', sans-serif",
                        raleway: "'Raleway', sans-serif",
                    },
                    extend: {},
                }
            }
        </script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


        <script src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')
            @include('layouts.sidebar')



            @include('layouts.navigation', [
                'route' => null,
                'show' => false,
            ])
            <section class="sm:ml-64 main">

                @include('layout.popup')

                <div class="flex  mx-4 mt-1 justify-between items-center">
                    <h1 class="text-[#26386A] mx-4 font-bold text-xl  py-2">Question Response</h1>
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
                        <div class="px-8 mt-4 text-lg font-poppins">
                            <h1 class="text-[#26386A]">{{ $question->question_text }}</h1>

                        </div>
                        <div class="w-full px-8 py-4  " id="chart{{ $question->id }}"></div>
                        <script>
                            var correctAnswer = {!! json_encode($question->correctAnswer()) !!};

                            var seriesData{{ $question->id }} = [];

                            // Loop through choices to build series data
                            @foreach ($question->choices as $choice)
                                var dataPoint{{ $question->id }} = {
                                    "x": "{{ $choice->choice_text }}",
                                    "y": {{ $question->examResponse->where('choice_id', $choice->id)->count() }},
                                    @if ($choice->choice_text === $question->correctAnswer())
                                        "fillColor": "#274FDC" // Green color for correct answer
                                    @else
                                        "fillColor": "#718297" // Blue color for incorrect answer
                                    @endif
                                };
                                seriesData{{ $question->id }}.push(dataPoint{{ $question->id }});
                            @endforeach

                            var options{{ $question->id }} = {
                                chart: {
                                    type: 'bar',
                                    height: 250,
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 4,
                                        horizontal: true,
                                        barWidth: 40,
                                    }
                                },


                                series: [{
                                    name: '{{ $question->content }}',
                                    data: seriesData{{ $question->id }},
                                }],
                                xaxis: {
                                    categories: {!! json_encode($question->getChoiceLabels()) !!},
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
