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


</head>

<body>
    <div class="min-h-screen  bg-[#EEF4F6]">

        @include('layout.sidenav');
        @include('layout.header');



        <section class="ml-[218px] main ">
            <div class="flex justify-evenly">


                <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                    <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


                    <div class="flex items-end gap-3 text-[#718297] mb-8">
                        <i class='bx bxs-user-detail text-[45px] pb-2'></i>
                        <p class="text-[50px] py-0">{{ $user->count() }}</p>
                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                    <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">Approve Application</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297]">
                        <i class='bx bxs-user-check text-[45px] pb-2'></i>
                        <p class="text-[50px] py-0">{{ $user->where('status', 'Approved')->count() }}</p>
                    </div>
                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>


                </div>

                <div class="bg-white mx-4 px-6 w-full relative rounded-lg">
                    <h1 class="text-[20px] pt-2 font-poppins font-bold text-[#26386A] ">Archive Application</h1>


                    <div class="flex items-end gap-3 px-2 text-[#718297]">
                        <i class='bx bxs-archive-in text-[40px] pb-2'></i>
                        <p class="text-[50px] py-0">{{ $user->where('status', 'Archived')->count() }}</p>


                    </div>

                    <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg"></div>

                </div>
            </div>


            <h1 class="text-[#26386A] font-bold text-lg mt-4 py-2 px-4">Recent Applicant</h1>
            <div class="bg-white mx-4  rounded-lg overflow-x-auto">


                <table class="min-w-full ">
                    <thead>
                        <tr class="border-b-2 border-[#718297]">
                            <th
                                class="px-6 py-4 text-left text-xl font-poppins font-bold text-[#26386A] uppercase tracking-wider">
                                Applicant
                            </th>


                            <th
                                class="px-6 py-4 text-left text-xl font-poppins font-bold  text-[#26386A] uppercase tracking-wider">
                                Date</th>

                            <th
                                class="px-6 py-4 text-left text-xl font-poppins font-bold  text-[#26386A] uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($recentApplicants as $recentApplicant)
                            <tr class="">
                                <td class="px-6 py-2  whitespace-nowrap">
                                    <p class="font-medium font-poppins text-[#617388]">
                                        {{ $recentApplicant->last_name }}, {{ $recentApplicant->first_name }}</p>
                                    <p class="text-[14px] font-poppins text-[#8898AC]"> {{ $recentApplicant->email }}
                                    </p>

                                </td>



                                <td class="px-6 py-2  whitespace-nowrap font-poppins text-[#617388] ">
                                    {{ $recentApplicant->admissionExam->created_at }}

                                </td>

                                <td class="px-4 py-2  whitespace-nowrap font-poppins">
                                    @if ($recentApplicant->status === 'Pending')
                                        <h1
                                            class="bg-orange-200 px-2 w-[120px] text-center  text-orange-700 rounded-lg py-1">
                                            Pending
                                        </h1>
                                    @elseif ($recentApplicant->status === 'Approved')
                                        <h1
                                            class="bg-[#C7FFD7] px-2 w-[120px] text-center  text-[#56A26B] rounded-lg py-1">
                                            Approved
                                        </h1>
                                    @elseif ($recentApplicant->status === 'Qualified')
                                        <h1
                                            class="bg-[#C7FFD7] px-2 w-[120px] text-center  text-[#56A26B] rounded-lg py-1">
                                            Qualified
                                        </h1>
                                    @elseif ($recentApplicant->status === 'Unqualified')
                                        <h1 class="bg-red-200 px-2 w-[120px] text-center  text-red-700 rounded-lg py-1">
                                            Unqualified
                                        </h1>
                                    @endif


                                </td>

                                <td>
                                    <a href="">
                                        <i class='bx bx-dots-horizontal-rounded text-[36px] text-[#617388]'></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div>

                </div>
            </div>
        </section>

    </div>

</body>

</html>
