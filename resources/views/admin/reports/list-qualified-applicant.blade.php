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
            @include('layouts.sidebar')


            @include('layouts.navigation', [
                'route' => null,
                'show' => false,
            ])
            <section class="sm:ml-64 main">

                @include('layout.popup')
                <div class="mx-4 my-4">

                    <div class="flex justify-between mx-4 my-2">

                        <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway">List of Qualified Applicants
                        </h1>

                        <div class="flex gap-2">
                            @include('admin.partials.select-acad-year', [
                                'route' => 'admin.reports.show.qualified-applicants',
                            ])

                            <a href="{{ route('admin.report.qualified-result', ['academicYears' => $selectedAcademicYear]) }}"
                                class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                                Export
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
                                        <td class="px-6 py-2">No.</td>
                                        <td class="px-6 py-2">Applicant Name</td>
                                        <td class="px-6 py-2">Interview Result</td>
                                        <td class="px-6 py-2">Admission Results</td>
                                        <td class="px-6 py-2">Qualifying Results</td>
                                        <td class="px-6 py-2">Weighted Average</td>
                                    </tr>
                                </thead>

                                <tbody class="text-center ">
                                    @if ($users->isEmpty())
                                        <td></td>
                                        <td class="px-6 py-3">No data found in database</td>
                                    @else
                                        @foreach ($users as $index => $user)
                                            <tr
                                                class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">

                                                <td class="px-6 py-3">{{ $index + 1 }}</td>
                                                <td class="px-6 py-2  whitespace-nowrap">
                                                    {{ $user->last_name }},
                                                    {{ $user->first_name }}</td>
                                                <td class="px-6 py-2  whitespace-nowrap">
                                                    <p class="font-medium font-poppins  text-[#617388]">
                                                        @if (empty($user->measure_a_score))
                                                            N/A
                                                        @else
                                                            {{ $user->measure_a_score }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="px-6 py-2  whitespace-nowrap">
                                                    <p class="font-medium font-poppins text-[#617388]">
                                                        @if (empty($user->measure_b_score))
                                                            N/A
                                                        @else
                                                            {{ $user->measure_b_score }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="px-6 py-2  whitespace-nowrap">
                                                    <p class="font-medium font-poppins text-[#617388]">
                                                        @if (empty($user->measure_c_score))
                                                            N/A
                                                        @else
                                                            {{ $user->measure_c_score }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="px-6 py-2  whitespace-nowrap">
                                                    <p class="font-medium font-poppins text-[#617388]">
                                                        @if ($user->weighted_average)
                                                            {{ $user->weighted_average }}
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
                            <nav
                                class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">

                                <a href="{{ $users->previousPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
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
                                <a href="{{ $users->nextPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                    <span class="">Next</span>

                                </a>
                            </nav>
                        </div>
            </section>
        </div>
    </body>

</html>
