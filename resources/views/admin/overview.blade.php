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
                                <p class="text-[40px] font-bold">
                                    {{ $totalCount }}</p>
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
                                <p class="text-[40px] font-bold">
                                    {{ $qualifiedCount }}</p>
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
                                <p class="text-[40px] font-bold">
                                    {{ $unqualifiedCount }}</p>
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
                                <p class="text-[40px] font-bold">
                                    {{ $waitlistedCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-[#26386A] mb-2 mt-5 mx-4 font-poppins text-base font-bold">Recent Activity</p>

                <div class="bg-white mx-4 relative mt-4 border   border-[#D9DBE3] shadow-md rounded-lg ">

                    <div class="overflow-x-auto">
                        <table id="admission-table"
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>


                                    <td class="px-6 py-2">

                                        Applicant Name
                                    </td>

                                    <td class="px-6 py-2">

                                        Status

                                    </td>

                                    <td class="px-6 py-2">Created At</td>

                                    <td class="px-6 py-2">Updated At</td>
                                </tr>

                            </thead>

                            <tbody class="text-left whitespace-nowrap ">
                                @if ($users->count() == 0)
                                    <tr>
                                        <td></td>
                                        <td class="">

                                            <p class="my-3">No Data found in the database</p>

                                        </td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($users as $index => $user)
                                        <tr
                                            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">

                                            <td class="px-6 py-3">
                                                {{ $user->last_name . ', ' . $user->first_name }}
                                            </td>

                                            <td class="px-6 py-3">
                                                @if ($user->status == 'Waitlisted')
                                                    <span
                                                        class="bg-sky-200  text-[14px] text-sky-700 py-1 px-2 rounded-md ">Waitlisted</span>
                                                @elseif($user->status == 'Qualified')
                                                    <span
                                                        class="bg-blue-200  text-[14px] text-blue-700 py-1 px-2 rounded-md ">Qualified</span>
                                                @elseif($user->status == 'Pending Interview')
                                                    <span
                                                        class="bg-amber-200  text-[14px] text-amber-700 py-1 px-2 rounded-md ">Pending
                                                        Interview</span>
                                                @elseif($user->status == 'Pending Schedule')
                                                    <span
                                                        class="bg-amber-200  text-[14px] text-amber-700 py-1 px-2 rounded-md ">Pending
                                                        Schedule</span>
                                                @elseif($user->status == 'Ready For Exam')
                                                    <span
                                                        class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Ready
                                                        For Exam</span>
                                                @elseif($user->status == 'Unqualified')
                                                    <span
                                                        class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Unqualified</span>
                                                @elseif($user->status == 'Archived')
                                                    <span
                                                        class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Archived</span>
                                                @elseif($user->status == 'Pending')
                                                    <span
                                                        class="bg-orange-200  text-[14px] text-orange-700 py-1 px-2 rounded-md ">Pending</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-3">
                                                {{ $user->created_at }}
                                            </td>
                                            <td class="px-6 py-3">
                                                {{ $user->updated_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <nav
                            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">

                        </nav>
                    </div>

                </div>



                <div class="mx-4 mt-6 flex gap-4 ">
                    <div class=" border border-gray-300 max-w-sm  w-full bg-white rounded-lg shadow  p-4 md:p-6">
                        <div class="flex justify-between border-gray-200 border-b  pb-3">
                            <dl>
                                <dt class="text-base  text-[#26386A] font-bold font-poppins  pb-1">Admission
                                </dt>

                            </dl>

                        </div>

                        <div class="grid grid-cols-3 py-3">
                            <dl>
                                <dt class="text-base font-normal text-gray-500  pb-1">Qualified</dt>
                                <dd class="leading-none text-xl font-bold text-green-500 ">
                                    {{-- {{ $qualifiedCount->where('status', 'Qualified')->count() }} --}}
                                </dd>
                            </dl>
                            <dl>
                                <dt class="text-base font-normal text-gray-500  pb-1">Unqualified</dt>
                                <dd class="leading-none text-xl font-bold text-red-600 ">
                                    {{-- {{ $qualifiedCount->where('status', 'Unqualified')->count() }} --}}
                                </dd>
                            </dl>
                            <dl>
                                <dt class="text-base font-normal text-gray-500  pb-1">Waitlisted</dt>
                                <dd class="leading-none text-xl font-bold text-blue-600 ">
                                    {{-- {{ $qualifiedCount->where('status', 'Waitlisted')->count() }} --}}
                                </dd>
                            </dl>
                        </div>

                        <div id="bar-chart"></div>
                        <div
                            class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                            <div class="flex justify-between items-center pt-5">



                                @if (Auth()->user()->role === 'Dean')
                                    <a href="{{ route('dean.admission') }}"
                                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700  hover:bg-gray-100  px-3 py-2">
                                        Admission Report
                                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <script>
                            // ApexCharts options and config
                            window.addEventListener("load", function() {
                                var labels = {!! json_encode($labels) !!};
                                var qualifiedData = {!! json_encode($qualifiedDataset) !!};
                                var unqualifiedData = {!! json_encode($unqualifiedDataset) !!};
                                var waitlistedData = {!! json_encode($waitlistedDataset) !!};

                                var options = {
                                    series: [{
                                            name: "Qualified",
                                            color: "#31C48D",
                                            data: qualifiedData,
                                        },
                                        {
                                            name: "Unqualified",
                                            color: "#FF0000",
                                            data: unqualifiedData,
                                        },
                                        {
                                            name: "Waitlisted",
                                            color: "#0000FF",
                                            data: waitlistedData,
                                        },
                                    ],
                                    chart: {
                                        sparkline: {
                                            enabled: false,
                                        },
                                        type: "bar",
                                        width: "100%",
                                        height: 400,
                                        toolbar: {
                                            show: false,
                                        }
                                    },
                                    fill: {
                                        opacity: 1,
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: true,
                                            columnWidth: "100%",
                                            borderRadiusApplication: "end",
                                            borderRadius: 6,
                                            dataLabels: {
                                                position: "top",
                                            },
                                        },
                                    },
                                    legend: {
                                        show: true,
                                        position: "bottom",
                                    },
                                    dataLabels: {
                                        enabled: false,
                                    },
                                    tooltip: {
                                        shared: true,
                                        intersect: false,
                                        formatter: function(value) {
                                            return "$" + value
                                        }
                                    },
                                    xaxis: {
                                        labels: {
                                            show: true,
                                            style: {
                                                fontFamily: "Inter, sans-serif",
                                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                            }
                                        },
                                        categories: labels,
                                        axisTicks: {
                                            show: false,
                                        },
                                        axisBorder: {
                                            show: false,
                                        },
                                    },
                                    yaxis: {
                                        labels: {
                                            show: true,
                                            style: {
                                                fontFamily: "Inter, sans-serif",
                                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                            }
                                        }
                                    },
                                    grid: {
                                        show: true,
                                        strokeDashArray: 4,
                                        padding: {
                                            left: 2,
                                            right: 2,
                                            top: -20
                                        },
                                    },
                                    fill: {
                                        opacity: 1,
                                    }
                                }

                                if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
                                    const chart = new ApexCharts(document.getElementById("bar-chart"), options);
                                    chart.render();
                                }
                            });
                        </script>
                    </div>



                    <div class="border border-gray-300 max-w-sm  w-full bg-white rounded-lg shadow  p-4 md:p-6">


                        <div class=" border-gray-200 border-b  pb-3">
                            <dl>
                                <dt class="text-base  text-[#26386A] font-bold font-poppins  pb-1">Item Analysis
                                </dt>

                            </dl>

                        </div>




                        <!-- Donut Chart -->
                        <div class="py-6 my-10" id="donut-chart"></div>

                        <div class="grid grid-cols-1 items-center border-gray-200 border-t  justify-between">
                            <div class="flex justify-between items-center pt-5">

                                <a href="{{ route('admin.dashboard.view-question') }}"
                                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700   hover:bg-gray-100px-3 py-2">
                                    Question
                                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <script>
                            var questionDataset = {!! json_encode($questionDataset) !!};

                            // ApexCharts options and config
                            window.addEventListener("load", function() {
                                const getChartOptions = () => {
                                    return {
                                        series: questionDataset,
                                        colors: ["#1C64F2", "#FDBA8C", "#E74694", "#16BDCA"],
                                        chart: {
                                            height: 420,
                                            width: "100%",
                                            type: "donut",
                                        },
                                        stroke: {
                                            colors: ["transparent"],
                                            lineCap: "",
                                        },
                                        plotOptions: {
                                            pie: {
                                                donut: {
                                                    labels: {
                                                        show: true,
                                                        name: {
                                                            show: true,
                                                            fontFamily: "Inter, sans-serif",
                                                            offsetY: 20,
                                                        },
                                                        total: {
                                                            showAlways: true,
                                                            show: true,
                                                            label: "Total Question",
                                                            fontFamily: "Inter, sans-serif",
                                                            formatter: function(w) {
                                                                const sum = w.globals.seriesTotals.reduce((a, b) => {
                                                                    return a + b
                                                                }, 0)
                                                                return `${sum}`
                                                            },
                                                        },
                                                        value: {
                                                            show: true,
                                                            fontFamily: "Inter, sans-serif",
                                                            offsetY: -20,
                                                            formatter: function(value) {
                                                                return value
                                                            },
                                                        },
                                                    },
                                                    size: "80%",
                                                },
                                            },
                                        },
                                        grid: {
                                            padding: {
                                                top: -2,
                                            },
                                        },
                                        labels: ["Retain", "Revise", "Discard", "Not Categorized"],
                                        dataLabels: {
                                            enabled: false,
                                        },
                                        legend: {
                                            position: "bottom",
                                            fontFamily: "Inter, sans-serif",
                                        },
                                        yaxis: {
                                            labels: {
                                                formatter: function(value) {
                                                    return value
                                                },
                                            },
                                        },
                                        xaxis: {
                                            labels: {
                                                formatter: function(value) {
                                                    return value
                                                },
                                            },
                                            axisTicks: {
                                                show: false,
                                            },
                                            axisBorder: {
                                                show: false,
                                            },
                                        },
                                    }
                                }

                                if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
                                    const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
                                    chart.render();


                                }
                            });
                        </script>
                    </div>


                    <div class="border border-gray-300 max-w-sm  w-full bg-white rounded-lg shadow  p-4 md:p-6">
                        <div class=" border-gray-200 border-b  pb-3">
                            <dl>
                                <dt class="text-base  text-[#26386A] font-bold font-poppins  pb-1">Applicant This Week
                                </dt>

                            </dl>

                        </div>
                        <div id="area-chart"></div>

                        <script>
                            // ApexCharts options and config
                            let userDataSet = @json($userDataSet);
                            window.addEventListener("load", function() {
                                let options = {
                                    chart: {
                                        height: "90%",
                                        maxWidth: "100%",
                                        type: "area",
                                        fontFamily: "Inter, sans-serif",
                                        dropShadow: {
                                            enabled: false,
                                        },
                                        toolbar: {
                                            show: true,
                                        },
                                    },
                                    tooltip: {
                                        enabled: true,
                                        x: {
                                            show: false,
                                        },
                                    },
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            opacityFrom: 0.55,
                                            opacityTo: 0,
                                            shade: "#1C64F2",
                                            gradientToColors: ["#1C64F2"],
                                        },
                                    },
                                    dataLabels: {
                                        enabled: false,
                                    },
                                    stroke: {
                                        width: 6,
                                    },
                                    grid: {
                                        show: true,
                                        strokeDashArray: 4,
                                        padding: {
                                            left: 2,
                                            right: 2,
                                            top: 0
                                        },
                                    },
                                    series: userDataSet.series,
                                    xaxis: {
                                        categories: userDataSet.categories,
                                        labels: {
                                            show: false,
                                        },
                                        axisBorder: {
                                            show: false,
                                        },
                                        axisTicks: {
                                            show: false,
                                        },
                                    },
                                    yaxis: {
                                        show: false,
                                    },
                                }

                                if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
                                    const chart = new ApexCharts(document.getElementById("area-chart"), options);
                                    chart.render();
                                }
                            });
                        </script>
                    </div>











                </div>







        </div>






        </section>

        </div>



    </body>

</html>
