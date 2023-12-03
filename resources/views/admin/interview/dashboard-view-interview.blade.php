<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Applicant </title>
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
    <div class="min-h-screen  bg-[#EEF4F6]">


        @include('layout.sidenav', ['active' => 0])
        <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

            <div class="flex items-center  ">
                <form method="get" action="{{ route('admin.dashboard.report.qualifying-exam') }}"
                    class="relative w-[300px]">
                    @csrf
                    <input type="text" name="searchTerm" placeholder="Search Here"
                        value="{{ request('searchTerm') }}"
                        class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                </form>
            </div>

            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
            </div>
        </nav>
        <section class="ml-[218px] main  ">
            <div class="flex justify-between mx-4 my-2">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway">Pending Interviews</h1>



            </div>
            <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                <div class="overflow-x-auto">
                    <table
                        class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                        <thead
                            class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                            <tr>
                                <td class="px-6 py-2">ID</td>
                                <td class="px-6 py-2">Applicant</td>
                                <td class="px-6 py-2">Interview Exam Schedule</td>
                                <td class="px-6 py-2">Time</td>
                                <td class="px-6 py-2">Actions</td>
                            </tr>
                        </thead>

                        <tbody class="text-left ">
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
                                        class="{{ $index % 2 == 0 ? 'bg-[#aecafd30]' : 'bg-white' }} border-b-2 border-gray-100 ">

                                        <td class="px-6 py-3">{{ $user->id }}</td>
                                        <td class="px-6 py-3 ">{{ $user->last_name . ', ' . $user->first_name }} </td>

                                        @if ($user->qualifiedStudent->exam_schedule_date != null)
                                            <td class="px-6 py-3  whitespace-nowrap">

                                                {{ \Carbon\Carbon::parse($user->qualifiedStudent->exam_schedule_date)->format('F j, Y') }}
                                            </td>

                                            <td class="px-6 py-3  whitespace-nowrap">

                                                {{ \Carbon\Carbon::parse($user->qualifiedStudent->start_time)->format('h:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($user->qualifiedStudent->end_time)->format('h:i A') }}

                                            </td>
                                        @else
                                            <td class="px-6 py-3 text-left  whitespace-nowrap">
                                                Not yet scheduled
                                            </td>
                                        @endif


                                        <td class="px-6 py-3 text-[#626B7F]">
                                            {{-- <a href="" class="mx-2" title="Schedule"><i
                                            class='bx bx-calendar-check'></i></a> --}}
                                            <a class="mx-1 hover:text-green-400"
                                                href="{{ route('admin.dashboard.interview-now', $user->id) }}"
                                                title="Interview Now">
                                                <i class='bx bx-conversation'></i>
                                            </a>

                                            <a href="{{ route('admin.dashboard.edit-qualified-appplicant', $user->id) }}"
                                                class="mx-1 hover:text-green-400" title="Edit"><i
                                                    class='bx bxs-edit '></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- <nav
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
                    </nav> --}}
                </div>

            </div>

        </section>

    </div>



</body>

</html>
