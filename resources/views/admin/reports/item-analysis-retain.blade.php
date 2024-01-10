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


    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')
            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <div class="flex items-center  ">
                    <form method="get" action="{{ route('admin.dashboard.report.qualifying-exam') }}"
                        class="relative w-[300px]">
                        @csrf
                        <input type="text" name="searchTerm" placeholder="Search Here"
                            value="{{ request('searchTerm') }}"
                            class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                        <i
                            class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    </form>
                </div>


                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')


                @include('admin.reports.layout.sub-header')

                <div class="mx-4 w-[200px]">



                    <form action="{{ route('admin.dashboard.item-analysis') }}" method="GET" id="yearForm">
                        <select id="year" name="selected_year"
                            class="font-poppins bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            onchange="document.getElementById('yearForm').submit()">
                            <option value="" selected>Select Year</option>
                            @foreach ($uniqueYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </form>

                </div>


                <div class="flex mx-4 mb-4" id="navLinks">

                    <a href="{{ route('admin.dashboard.item-analysis') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">All Items</a>
                    <a href="{{ route('admin.dashboard.item-analysis.revise') }}"
                        class="font-poppins  text-slate-500 nav-link   whitespace-nowrap">Revise Items</a>
                    <a href="{{ route('admin.dashboard.item-analysis.retain') }}"
                        class="font-poppins active  text-slate-500 nav-link whitespace-nowrap">Retain Items</a>
                    <a href="{{ route('admin.dashboard.item-analysis.discard') }}"
                        class="font-poppins   text-slate-500 nav-link whitespace-nowrap">Discard Items</a>


                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>
                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg my-4">
                    <div class="overflow-x-auto overflow-y-auto">
                        <table
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b  text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">Item </td>
                                    <td class="px-6 py-2 text-center">Difficulty Index</td>
                                    <td class="px-6 py-2 text-center">Difficulty Level</td>
                                    <td class="px-6 py-2 text-center">Status</td>

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
                                                        Discarded
                                                    @elseif ($DI[$index] > 0.14 && $DI[$index] < 0.3)
                                                        Revised
                                                    @elseif ($DI[$index] > 0.29 && $DI[$index] < 0.71)
                                                        Retained
                                                    @elseif ($DI[$index] > 0.7 && $DI[$index] < 0.86)
                                                        Revised
                                                    @elseif ($DI[$index] > 0.85)
                                                        Discarded
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



            </section>

        </div>

    </body>

</html>
