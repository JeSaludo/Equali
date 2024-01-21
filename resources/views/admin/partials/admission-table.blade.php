<div class="flex  mx-4 mt-4 justify-between">


    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">{{ $title }}</h1>



    <div class="flex gap-2">

        <div>
            <form action="{{ route($route) }}" method="GET" id="yearForm">
                <select id="selectAcademicYear" name="academicYears"
                    onchange="document.getElementById('yearForm').submit()"
                    class="py-1 text-[16px] w-full rounded border border-[#D9DBE3] px-6">
                    @if ($academicYears->isEmpty())
                        <option value="" disabled selected>No Existing academic year</option>
                    @else
                        <option value="" {{ empty($request->academicYears) ? 'selected' : '' }}>
                            All</option>
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


        @if (Auth::user()->role === 'ProgramHead')
            @if ($show === true)
                <button id="addApplicantBtn"
                    class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                    <i id="icon" class='bx bx-plus pr-1'></i>Add Applicant
                </button>
            @endif
        @endif
    </div>

</div>
<div class="bg-white mx-4 relative mt-4 border   border-[#D9DBE3] shadow-md rounded-lg ">
    <div class="overflow-x-auto">
        <table id="admission-table"
            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
            <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                <tr>
                    <td class="px-6 py-2">
                        <a
                            href="{{ route($route, [
                                'sort_column' => 'id',
                                'sort_order' => $sortColumn == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                'academicYears' => $request->academicYears,
                                'page' => $users->currentPage(),
                            ]) }}">
                            ID <i class='bx bxs-sort-alt'></i>
                        </a>
                    </td>

                    <td class="px-6 py-2">
                        <a
                            href="{{ route($route, [
                                'sort_column' => 'last_name',
                                'sort_order' => $sortColumn == 'last_name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                'academicYears' => $request->academicYears,
                                'page' => $users->currentPage(),
                            ]) }}">
                            Applicant Name <i class='bx bxs-sort-alt'></i>
                        </a>
                    </td>
                    @if ($showAdmissionExam)
                        <td class="px-6 py-2">
                            <a
                                href="{{ route($route, [
                                    'sort_column' => 'raw_score',
                                    'sort_order' => $sortColumn == 'raw_score' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    'academicYears' => $request->academicYears,
                                    'page' => $users->currentPage(),
                                ]) }}">
                                Raw Score <i class='bx bxs-sort-alt'></i>
                            </a>
                        </td>

                        <td class="px-6 py-2">
                            <a
                                href="{{ route($route, [
                                    'sort_column' => 'percentage',
                                    'sort_order' => $sortColumn == 'percentage' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    'academicYears' => $request->academicYears,
                                    'page' => $users->currentPage(),
                                ]) }}">
                                Percentage <i class='bx bxs-sort-alt'></i>
                            </a>
                        </td>
                    @endif
                    <td class="px-6 py-2">
                        <a
                            href="{{ route($route, [
                                'sort_column' => 'status',
                                'sort_order' => $sortColumn == 'status' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                'academicYears' => $request->academicYears,
                                'page' => $users->currentPage(),
                            ]) }}">
                            Status <i class='bx bxs-sort-alt'></i>
                        </a>
                    </td>

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
                        <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3">{{ $user->last_name . ', ' . $user->first_name }}
                            </td>
                            @if ($showAdmissionExam)
                                <td class="px-6 py-3">
                                    {{ $user->raw_score }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ $user->percentage }}
                                </td>
                            @endif
                            <td class="px-6 py-3">
                                @if ($user->status == 'Waitlisted')
                                    <span
                                        class="bg-sky-200  text-[14px] text-sky-700 py-1 px-2 rounded-md ">Waitlisted</span>
                                @elseif($user->status == 'Qualified')
                                    <span
                                        class="bg-blue-200  text-[14px] text-blue-700 py-1 px-2 rounded-md ">Qualified</span>
                                @elseif($user->status == 'Pending Interview')
                                    <span class="bg-amber-200  text-[14px] text-amber-700 py-1 px-2 rounded-md ">Pending
                                        Interview</span>
                                @elseif($user->status == 'Pending Schedule')
                                    <span class="bg-amber-200  text-[14px] text-amber-700 py-1 px-2 rounded-md ">Pending
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
                                @if ($user->status == 'Waitlisted')
                                    <a href="{{ route('admin.dashboard.show-waitlisted', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>
                                @elseif($user->status == 'Qualified')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>
                                    <a href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                        onclick="return confirm('Are you sure you want to archive this user?')"
                                        class="mx-2 text-[12px] bg-rose-600 py-1 px-3 hover:bg-rose-800 text-white rounded-md">Archive</a>
                                    </a>
                                @elseif($user->status == 'Ready For Exam' || $user->status == 'Ready For Interview')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>
                                    <a href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                        onclick="return confirm('Are you sure you want to archive this user?')"
                                        class="mx-2 text-[12px] bg-rose-600 py-1 px-3 hover:bg-rose-800 text-white rounded-md">Archive</a>
                                    </a>
                                @elseif($user->status == 'Unqualified')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>
                                    <a href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                        onclick="return confirm('Are you sure you want to archive this user?')"
                                        class="mx-2 text-[12px] bg-rose-600 py-1 px-3 hover:bg-rose-800 text-white rounded-md">Archive</a>
                                    </a>
                                @elseif($user->status == 'Archived')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>
                                    <form action="{{ route('admin.dashboard.delete-applicant', $user->id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button utton type="submit" title="Delete"
                                            class="mx-2 text-[12px] bg-red-600 py-1 px-3 hover:bg-red-800 text-white rounded-md"
                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                @elseif($user->status == 'Pending Interview')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>

                                    <a href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                        onclick="return confirm('Are you sure you want to archive this user?')"
                                        class="mx-2 text-[12px] bg-rose-600 py-1 px-3 hover:bg-rose-800 text-white rounded-md">Archive</a>
                                    </a>
                                @elseif($user->status == 'Pending Schedule')
                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                        class="text-[12px] bg-blue-600 py-1 px-3 hover:bg-blue-900 text-white rounded-md">View</a>


                                    <a href="{{ route('admin.dashboard.archive-applicant', $user->id) }}"
                                        onclick="return confirm('Are you sure you want to archive this user?')"
                                        class="mx-2 text-[12px] bg-rose-500 py-1 px-3 hover:bg-rose-800 text-white rounded-md">Archive</a>
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

            <a href="{{ $users->previousPageUrl() . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                <span class="">Previous</span>
            </a>

            <div class="flex">
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <a href="{{ $users->url($i) . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $users->currentPage() ? 'bg-slate-100' : '' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>

            <a href="{{ $users->nextPageUrl() . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                <span class="">Next</span>
            </a>

        </nav>

    </div>

</div>
