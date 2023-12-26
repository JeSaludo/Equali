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
        @vite('resources/css/app.css')
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    </head>

    <body>





        <div class="min-h-screen  bg-[#F7F7F7]">

            @include('layout.danger-alert')

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4 ">
                @include('layout.user-popup')
            </nav>

            <section class="ml-[218px] main">
                @include('layout.popup')

                @include('admin.dean.card')
                <div class="flex  mx-4 mt-4 justify-between">


                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Interview</h1>






                </div>

                <div class="bg-white mx-4 relative mt-4 border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">ID</td>
                                    <td class="px-6 py-2">Applicant Name</td>

                                    <td class="px-6 py-2">Status</td>
                                    <td class="px-6 py-2">Action</td>
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
                                            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                            <td class="px-6 py-3">{{ $user->id }}</td>
                                            <td class="px-6 py-3">{{ $user->last_name . ', ' . $user->first_name }}</td>

                                            <td class="px-6 py-3">
                                                @if ($user->status == 'WaitListed')
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
                                            <td class="px-4 py-3 flex items-center justify-start">
                                                @if ($user->status == 'WaitListed')
                                                    <a class="hover:text-green-400 mx-1"
                                                        href="{{ route('admin.dashboard.qualify-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to qualified this user?')">
                                                        <i class='bx bx-user-check bx-sm'></i>
                                                    </a>

                                                    <a class="hover:text-red-400 mx-1"
                                                        href="{{ route('admin.dashboard.unqualify-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to unqualify this user?')">
                                                        <i class='bx bx-user-x bx-sm'></i>
                                                    </a>
                                                @elseif($user->status == 'Qualified')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>
                                                    <a class="hover:text-red-400 mx-1" title="Archive"
                                                        href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-archive-in '></i>
                                                    </a>
                                                @elseif($user->status == 'Ready For Exam' || $user->status == 'Ready For Interview')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>
                                                    <a class="hover:text-red-400 mx-1" title="Archive"
                                                        href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-archive-in '></i>
                                                    </a>
                                                @elseif($user->status == 'Unqualified')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>

                                                    <a class="hover:text-red-400 mx-1"
                                                        href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-archive-in '></i>
                                                    </a>
                                                @elseif($user->status == 'Archived')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>
                                                    <form
                                                        action="{{ route('admin.dashboard.delete-applicant', $user->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button utton type="submit" title="Delete"
                                                            class="mx-1   hover:text-red-400"
                                                            onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                                class='bx bxs-trash '></i></button>
                                                    </form>
                                                @elseif($user->status == 'Pending')
                                                    <a class="hover:text-green-400 mx-1" title="Approve"
                                                        href="{{ route('admin.dashboard.approve-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to approve this user?')">
                                                        <i class='bx bx-user-check bx-sm'></i>
                                                    </a>

                                                    <a class="hover:text-red-400 mx-1" title="Reject"
                                                        href="{{ route('admin.dashboard.reject-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-user-x bx-sm '></i>
                                                    </a>


                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit '></i></a>

                                                    <form
                                                        action="{{ route('admin.dashboard.delete-applicant', $user->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete"
                                                            class="mx-1   hover:text-red-400"
                                                            onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                                class='bx bxs-trash '></i></button>

                                                    </form>
                                                @elseif($user->status == 'Pending Interview')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>

                                                    <a class="hover:text-red-400 mx-1"
                                                        href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-archive-in '></i>
                                                    </a>
                                                @elseif($user->status == 'Pending Schedule')
                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit'></i></a>

                                                    <a class="hover:text-red-400 mx-1"
                                                        href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-archive-in '></i>
                                                    </a>
                                                @endif
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
                            {{-- Next Page Link --}}


                        </nav>
                    </div>

                </div>



                @include('admin.program-head.add-applicant')







            </section>

        </div>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
