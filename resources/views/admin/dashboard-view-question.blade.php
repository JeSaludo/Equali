<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Question </title>
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
        <div class="min-h-screen  bg-[#F7F7F7] ">
            @include('layout.danger-alert')



            @include('layouts.sidebar')
            @include('layouts.navigation', [
                'route' => null,
                'show' => false,
            ])


            <section class="sm:ml-64 main">

                @include('layout.popup')

                <div class="grid md:mx-2 grid-col md:grid-cols-3 gap-4 mt-4">

                    <a href="{{ route('admin.dashboard.view-question') }}" class="flex flex-col h-full">


                        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[16px] pt-2 font-poppins font-bold text-[#26386A] ">All Question</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8 ">
                                <i class='bx bxs-box text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $questionCount->count() }}</p>
                            </div>

                            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>

                    </a>

                    <a href="{{ route('admin.dashboard.view-question-retain') }}" class="flex flex-col h-full">

                        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[16px] pt-2 font-poppins font-bold text-[#26386A] ">Retain Question</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8 ">
                                <i class='bx  bxs-box text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $questionCount->where('category', 'Retain')->count() }}
                            </div>

                            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>


                    </a>

                    <a href="{{ route('admin.dashboard.view-question-discard') }}" class="flex flex-col h-full">
                        <div class="bg-white mx-4 px-6 relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                            <h1 class="text-[16px] pt-2 font-poppins font-bold text-[#26386A] ">Discard Question</h1>


                            <div class="flex items-end gap-3 text-[#718297] mb-8 ">
                                <i class='bx bxs-archive text-[30px] pb-2'></i>
                                <p class="text-[36px] py-0">{{ $questionCount->where('category', 'Discard')->count() }}
                            </div>

                            <div class="bg-[#5587F7] w-full  py-3 absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                            </div>

                        </div>
                    </a>

                </div>

                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Question</h1>
                    <a id="addQuestionBtn" href="{{ route('admin.dashboard.add-question') }}"
                        class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                        <i id="icon" class='bx bx-plus-medical pr-2'></i> Add
                        Question</a>
                </div>
                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">Question No.</td>
                                    <td class="px-6 py-2">Question</td>

                                    <td class="px-6 py-2">
                                        <a
                                            href="{{ route('admin.dashboard.view-question', [
                                                'sort_column' => 'category',
                                                'sort_order' => $sortColumn == 'category' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            ]) }}">
                                            Category <i class='bx bxs-sort-alt'></i>
                                        </a>
                                    </td>
                                    <td class="px-6 py-2"><a
                                            href="{{ route('admin.dashboard.view-question', [
                                                'sort_column' => 'created_at',
                                                'sort_order' => $sortColumn == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            ]) }}">
                                            Created At <i class='bx bxs-sort-alt'></i>
                                        </a></td>
                                    <td class="px-6 py-2">Action</td>
                                </tr>
                            </thead>
                            <tbody class="text-left ">
                                @if ($questions->count() == 0)
                                    <tr>
                                        <td></td>
                                        <td class="">

                                            <p class="my-3">No Data found in the database</p>

                                        </td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($questions as $index => $question)
                                        <tr
                                            class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                            <td class="px-6 py-3">Question {{ $question->id }}</td>
                                            <td class="px-6 py-3">
                                                @if (strlen($question->question_text) >= 36)
                                                    {{ substr($question->question_text, 0, 36) }}...
                                                @else
                                                    {{ $question->question_text }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 ">
                                                @if ($question->category == null)
                                                    <span class="py-1 px-4 rounded-md bg-slate-200 text-slate-600">Not
                                                        Yet analyzed </span>
                                                @elseif ($question->category == 'Discard')
                                                    <span
                                                        class="py-1 px-4 rounded-md bg-red-200 text-red-600">Discarded</span>
                                                @elseif ($question->category == 'Retain')
                                                    <span
                                                        class="py-1 px-4 rounded-md bg-blue-200 text-blue-600">Retained</span>
                                                @elseif ($question->category == 'Revised')
                                                    <span
                                                        class="py-1 px-4 rounded-md bg-yellow-200 text-yellow-600">Revised</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3">
                                                {{ $question->created_at->format('Y-m-d') }}


                                            <td class="px-6 py-3"><a
                                                    href="{{ route('admin.dashboard.edit-question', $question) }}"><i
                                                        class='bx bxs-edit'></i></a>

                                                <form
                                                    action="{{ route('admin.dashboard.delete-question', $question) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="mx-2  hover:text-indigo-900"
                                                        onclick="return confirm('Are you sure you want to delete this question?')"><i
                                                            class='bx bxs-trash'></i></button>

                                                </form>
                                                <a href="{{ route('admin.show-question-read-only', $question->id) }}">
                                                    <i class='bx bx-show'></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <nav
                            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">

                            <a href="{{ $questions->previousPageUrl() . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $questions->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Previous</span>

                            </a>




                            <div class="flex">
                                @for ($i = 1; $i <= $questions->lastPage(); $i++)
                                    <a href="{{ $questions->url($i) . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $questions->currentPage() ? 'bg-slate-100' : '' }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                            </div>
                            <a href="{{ $questions->nextPageUrl() . '&sort_column=' . $sortColumn . '&sort_order=' . $sortOrder }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $questions->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                <span class="">Next</span>

                            </a>
                            {{-- Next Page Link --}}
                        </nav>
                    </div>
                </div>
        </div>








        </section>

        </div>





    </body>

</html>
