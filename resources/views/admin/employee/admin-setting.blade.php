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
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')
            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">
                @include('layout.user-popup')



            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="  bg-white  h-screen">

                    <div class="p-8">
                        <div class="">
                            <h1 class="text-[22px] font-poppins  px-6 font-semibold text-[#26386A]"> Exam Setting
                            </h1>
                            <p class="text-[14px] font-poppins  px-6 font-noprmal text-gray-500">Edit your exam setting
                                here
                            </p>
                        </div>

                        <form id="settingForm" class=" mt-10" action="{{ route('admin.update.setting') }}"
                            method="post">
                            @csrf
                            @method('PUT')

                            <div class="px-6 w-4/12">
                                <label for="" class="my-0 text-gray-600 font-poppins ">Exam Passing
                                    Score:</label>
                                <div class=" w-full  mb-4 mt-1">
                                    <input type="number" name="qualifying_passing_score"
                                        value="{{ $option->qualifying_passing_score }}"
                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                        placeholder="Passing Score" required autocomplete="off">

                                </div>



                                <label for="" class="my-0 text-gray-600 font-poppins ">Number of Exam
                                    Items:</label>
                                <div class=" w-full  mb-4 mt-1">
                                    <input type="number" name="qualifying_number_of_items"
                                        value="{{ $option->qualifying_number_of_items }}"
                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                        placeholder="Enter number of exam items" required autocomplete="off">

                                </div>

                                <label for="exam_timer" class="my-0 text-gray-600 font-poppins">Exam Timer (in
                                    minutes):</label>
                                <div class="w-full mb-4 mt-1">
                                    <input type="number" name="qualifying_timer"
                                        value="{{ $option->qualifying_timer }}"
                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                        placeholder="Enter exam duration in minutes" required autocomplete="off">
                                </div>

                                <label for="" class="my-0 text-gray-600 font-poppins ">Qualified Passing Average
                                </label>
                                <div class=" w-full  mb-4 mt-1">
                                    <input type="number" name="qualified_student_passing_average"
                                        value="{{ $option->qualified_student_passing_average }}" step="0.01"
                                        max="5"
                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                        placeholder="Enter number of exam items" required autocomplete="off">

                                </div>

                                <div class="relative my-6">
                                    <input type="submit" value="Save"
                                        class="text-lg font-poppins font-normal mr-2 w-full h-[45px] rounded-md bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>
                            </div>



                            @if ($errors->has('error'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif




                        </form>
                    </div>

                </div>

            </section>



        </div>




    </body>

</html>
