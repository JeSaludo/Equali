<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Admission </title>
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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

                <div class="mt-4 mx-4 flex justify-between items-end">
                    <div class="my-1">
                        <h1 class=" text-2xl font-poppins font-medium">Dashboard</h1>


                        <nav class="flex  " aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="#"
                                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                        <i class='bx bxs-home pr-1'></i>
                                        Dashboard
                                    </a>
                                </li>

                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 ">Overview</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>


                    <div>
                        <div class="flex justify-end">
                            <form action="{{ route('dashboard.overview') }}" method="GET" id="yearForm"
                                class="w-[200px]">
                                <select id="selectAcademicYear" name="academicYears"
                                    onchange="document.getElementById('yearForm').submit()"
                                    class="py-1 text-[16px] w-full rounded border border-[#D9DBE3] px-6">
                                    @if ($academicYears->isEmpty())
                                        <option value="" disabled selected>No Existing academic year</option>
                                    @else
                                        @if (empty($request->academicYears))
                                            <option value="{{ $selectedDefaultYear->id }}" selected>
                                                {{ $selectedDefaultYear->year_name }}</option>
                                        @endif


                                        @foreach ($academicYears as $acadYear)
                                            <option value="{{ $acadYear->id }}"
                                                {{ $acadYear->id == old('academicYears', $request->academicYears) ? 'selected' : '' }}>
                                                {{ $acadYear->year_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mx-4">



                </div>
                <div class="mx-4 grid-rows-1  sm:grid grid-cols-2 gap-4 mt-4  ">
                    <div
                        class=" bg-white rounded-lg p-6 border border-gray-300 font-poppins text-gray-700 mt-2 h-[fit-content]">
                        <div class="flex">
                            <div class="w-24 h-24 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class='mx-auto bx bx-lg text-white bxs-user-detail text-center'></i>
                            </div>
                            <div class="mx-6 py-1">
                                <p class="text-xl">Total Applicants</p>
                                <p class="text-[40px] font-bold">100</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class=" w-full bg-white rounded-lg p-6 border border-gray-300 font-poppins text-gray-700 mt-2 h-[fit-content]">
                        <div class="flex">
                            <div class="w-24 h-24 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class='mx-auto bx bx-lg text-white bxs-user-check text-center'></i>
                            </div>
                            <div class="mx-6 py-1">
                                <p class="text-xl">Qualified Applicants</p>
                                <p class="text-[40px] font-bold">100</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class=" w-full bg-white rounded-lg p-6 border border-gray-300 font-poppins text-gray-700 mt-2 h-[fit-content]">
                        <div class="flex">
                            <div class="w-24 h-24 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class='mx-auto bx bx-lg text-white bxs-user-x text-center'></i>
                            </div>
                            <div class="mx-6 py-1">
                                <p class="text-xl">Unqualified Applicants</p>
                                <p class="text-[40px] font-bold">100</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class=" w-full bg-white rounded-lg p-6 border border-gray-300 font-poppins text-gray-700 mt-2 h-[fit-content]">
                        <div class="flex">
                            <div class="w-24 h-24 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class='mx-auto bx bx-lg text-white bxs-timer text-center'></i>
                            </div>
                            <div class="mx-6 py-1">
                                <p class="text-xl">Waitlisted Applicants</p>
                                <p class="text-[40px] font-bold">100</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 bg-white border border-gray-300 shadow-md mx-4 p-4 rounded-lg ">
                    <p class="mx-4 text-lg font-poppins font-bold">Overview</p>



                    <canvas id="myChart"></canvas>
                    <div class="my-4 mx-4">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                            onclick="previousMonth()">Previous Month</button>
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                            onclick="nextMonth()">Next Month</button>
                    </div>


                    <script>
                        var dateRangeLabels = {!! $dateRange !!};
                        var qualifiedData = {!! isset($chartData['qualifiedData']) ? $chartData['qualifiedData'] : '[]' !!};
                        var unqualifiedData = {!! isset($chartData['unqualifiedData']) ? $chartData['unqualifiedData'] : '[]' !!};
                        var waitlistedData = {!! isset($chartData['waitlistedData']) ? $chartData['waitlistedData'] : '[]' !!};

                        var currentMonthIndex = 0; // Initial index

                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart;

                        function updateChart() {
                            myChart.data.labels = dateRangeLabels.slice(currentMonthIndex, currentMonthIndex + 4);
                            myChart.data.datasets[0].data = qualifiedData.slice(currentMonthIndex, currentMonthIndex + 4);
                            myChart.data.datasets[1].data = unqualifiedData.slice(currentMonthIndex, currentMonthIndex + 4);
                            myChart.data.datasets[2].data = waitlistedData.slice(currentMonthIndex, currentMonthIndex + 4);
                            myChart.update();
                        }

                        function nextMonth() {
                            currentMonthIndex = (currentMonthIndex + 1) % (dateRangeLabels.length - 3);
                            updateChart();
                        }

                        function previousMonth() {
                            // Ensure the index doesn't go below 0
                            currentMonthIndex = (currentMonthIndex - 1 + dateRangeLabels.length - 3) % (dateRangeLabels.length - 3);
                            updateChart();
                        }

                        myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: dateRangeLabels.slice(currentMonthIndex, currentMonthIndex + 4),
                                datasets: [{
                                        label: 'Qualified',
                                        data: qualifiedData.slice(currentMonthIndex, currentMonthIndex + 4),
                                        backgroundColor: 'rgba(39, 220, 101, 1)'
                                    },
                                    {
                                        label: 'Unqualified',
                                        data: unqualifiedData.slice(currentMonthIndex, currentMonthIndex + 4),
                                        backgroundColor: 'rgba(220, 39, 82, 1)'
                                    },
                                    {
                                        label: 'Waitlisted',
                                        data: waitlistedData.slice(currentMonthIndex, currentMonthIndex + 4),
                                        backgroundColor: 'rgba(39, 79, 220, 1)'
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        precision: 0,

                                    }
                                },
                            }
                        });
                    </script>




                </div>






            </section>

        </div>



    </body>

</html>
