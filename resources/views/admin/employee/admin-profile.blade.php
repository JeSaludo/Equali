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


            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">






                @include('layout.user-popup')
            </nav>
            <section class="sm:ml-64 main">

                @include('layout.popup')

                <div class="  bg-white  h-screen">

                    <div class="p-8">
                        <div class="">
                            <h1 class="text-[22px] font-poppins  px-6 font-semibold text-[#26386A]">Edit Profile </h1>
                            <p class="text-[14px] font-poppins  px-6 font-noprmal text-gray-500">Edit your information
                                here </p>
                        </div>

                        <form class=" mt-10" action="{{ route('admin.update.profile', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="px-6 w-5/12">
                                <div class="flex  gap-2 my-4 ">
                                    <div class=" w-full ">
                                        <input type="text" name="first_name" value="{{ $user->first_name }}"
                                            class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                            placeholder="First Name" required autocomplete="off">

                                    </div>

                                    <div class="w-full  ">
                                        <input type="text" name="last_name" value="{{ $user->last_name }}"
                                            class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3]"
                                            placeholder="Last Name" required autocomplete="off">

                                    </div>
                                </div>

                                <div class=" my-4">
                                    <input type="email" name="email" value="{{ $user->email }}"
                                        class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3] "
                                        placeholder="Email Address" required autocomplete="off">

                                </div>

                                {{-- <div class=" my-4">
                                <input type="password" name="curent_password" 
                                    class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3] "
                                    placeholder="Old Password"  autocomplete="off">
        
                            </div>
                         

                            <div class=" my-4">
                                <input type="text" name="password" 
                                    class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3] "
                                    placeholder="New Password"  autocomplete="off">
        
                            </div>
        
                            <div class="relative my-4">
                                <input type="text" name="password_confirmation"
                                    class="h-[45px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border border-[#D9DBE3] "
                                    placeholder="Confirm Password"  autocomplete="off">
        
                            </div> --}}



                                <div class="relative my-6">
                                    <input type="submit" value="Update Profile"
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
