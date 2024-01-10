<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Register </title>
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
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <div class="min-h-screen w-[1440px] mx-auto ">
            @include('layout.danger-alert')
            <nav class="h-[60px] flex justify-between mx-[40px]">

                <div class="w-[500px] flex justify-between items-center">
                    <div>
                        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.
                        </h1>
                    </div>
                </div>

                <div class=" flex justify-between items-center">
                    <a href="{{ route('auth.login') }}"
                        class=" bg-[#2B6BE6]  text-white mx-[4px] px-8 py-2 rounded-[18px] hover:bg-[#134197] ">Sign
                        in</a>
                </div>
            </nav>

            <div class="relative">
                <img class="absolute w-[160px] h-[123px] right-20 top-20 "src="{{ asset('img\Student-2.png') }}"
                    alt="" srcset="">

                <img class="absolute w-[110px] h-[113px] left-60  top-40 "src="{{ asset('img\Student-1.png') }}"
                    alt="" srcset="">
            </div>

            <div class="w-full mt-6 ">
                <div class="mx-auto w-[480px] h-[600px] border-1 bg-[#EBEFF9] rounded-[20px] shadow-lg ">
                    <div class="mx-auto text-center ">
                        <h1 class="pt-8 font-bold font-poppins text-[46px]">Signup to <span
                                class="text-[#3530AD]">Equali</span></h1>
                        <p class="text-[18px] text-center w-7/12 mx-auto">Hello, This is only a text template for this
                            webpage</p>
                    </div>

                    <form class="mx-14 mt-8" action="{{ route('auth.store.admin.registration') }}" method="post">
                        @csrf


                        <div class="relative my-4 autofill:text-black ">
                            <input type="email" name="email"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0]"
                                placeholder="Email Address" required autocomplete="off">

                        </div>

                        <div class="relative my-4 flex w-full">
                            <div
                                class="h-[50px] py-3 w-5/12 bg-white whitespace-nowrap placeholder:text-[#4E4E4E]  px-[40px] rounded-l   border-x-2 border-y-2 border-r-2 border-[#D7D8D0]">
                                <label for="">Admin Type </label>
                            </div>
                            <select name="role"
                                class="h-[50px] w-full  placeholder:text-[#4E4E4E]  px-[40px] rounded-r border-y-2 border-r-2 border-[#D7D8D0]"
                                autocomplete="off">
                                <option disabled selected>Choose a Role</option>
                                <option value="ProgramHead">Program Head</option>
                                <option value="Proctor">Proctor</option>
                                <option value="Dean">Dean</option>

                            </select>
                        </div>

                        <div class="relative my-4">
                            <input type="password" name="password"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                placeholder="Password" required autocomplete="off">

                        </div>

                        <div class="relative my-4">
                            <input type="password" name="password_confirmation"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                placeholder="Confirm Password" required autocomplete="off">

                        </div>





                        <div class="relative my-6">
                            <input type="submit" value="Create Account"
                                class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                        </div>


                    </form>


                </div>
                <div class="relative mt-[29px]">
                    <img class="absolute bottom-0 left-0" src="{{ asset('img/Programming-v2.png') }}" alt="">
                    <img class="absolute bottom-0 right-0" src="{{ asset('img/reading-v2.png') }}" alt="">

                </div>

            </div>





        </div>

    </body>

</html>
