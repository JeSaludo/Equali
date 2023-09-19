<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Login </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="min-h-screen w-[1440px] mx-auto ">

        <nav class="h-[60px] flex justify-between mx-[40px]">

            <div class="w-[500px] flex justify-between items-center">
                <div>
                    <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.</h1>
                </div>
            </div>


        </nav>

        <div class="relative">
            <img class="absolute w-[160px] h-[123px] right-20 top-20 "src="{{ asset('img\Student-2.png') }}"
                alt="" srcset="">
            <img class="absolute w-[130px] h-[93px] inset-x-1/3 mx-[90px] my-96 top-36"
                src="{{ asset('img\Student-3.png') }}" alt="" srcset="">
            <img class="absolute w-[110px] h-[113px] left-60  top-40 "src="{{ asset('img\Student-1.png') }}"
                alt="" srcset="">
        </div>

        <div class="w-full mt-6 ">
            <div class="mx-auto w-[480px] h-[550px] border-1 bg-[#EBEFF9] rounded-[20px] shadow-lg">
                <div class="mx-auto text-center ">
                    <h1 class="pt-8 font-bold font-poppins text-[46px]">Login to <span
                            class="text-[#3530AD]">Equali</span></h1>
                    <p class="text-[18px] text-center w-7/12 mx-auto">Hello, Enter your details to get sign in to your
                        account</p>
                </div>

                <form class="mx-14 mt-8" action="{{ route('auth.authenticate') }}" method="post">
                    @csrf
                    <div class="relative my-4">
                        <input type="text" name="email"
                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0]"
                            placeholder="Email Address" required autocomplete="off">
                        <i class='bx bx-user  text-[#4E4E4E] absolute left-0 py-4 px-4'></i>
                    </div>

                    <div class="relative my-6">
                        <input type="password" name="password"
                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                            placeholder="Password" required autocomplete="off">
                        <i class='bx bxs-lock-alt  text-[#4E4E4E] absolute left-0 py-4 px-4'></i>
                    </div>

                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <input checked id="checked-checkbox" type="checkbox" value=""
                                class="w-4 h-4 text-[#3530AD] bg-transparent border-[#4E4E4E] rounded focus:ring-blue-500 ">
                            <label for="checked-checkbox"
                                class="ml-2 text-sm font-normal font-poppins text-[#4E4E4E] dark:text-[#4E4E4E]">Remember
                                Me</label>
                        </div>

                        <div>
                            <a class="text-[#4E4E4E] underline" href="">Forgot Password?</a>
                        </div>
                    </div>


                    <div class="relative my-6">
                        <input type="submit" value="Login"
                            class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                    </div>

                    <div class="relative my-2 mx-auto">
                        @error('email')
                            <h1 class="bg-gray-200 p-3 text-[12px] rounded-md text-red-500 font-bold font-poppins">
                                {{ $message }}
                            </h1>
                        @enderror

                        @if (session('status'))
                            <div class="bg-gray-200 p-3 text-[12px] rounded-md text-green-500 font-bold font-poppins">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>




                </form>


            </div>
            <div class="relative mt-[171px]">
                <img class="absolute bottom-0 left-0" src="{{ asset('img/Programming-v2.png') }}" alt="">
                <img class="absolute bottom-0 right-0" src="{{ asset('img/reading-v2.png') }}" alt="">

            </div>

        </div>





    </div>

</body>

</html>
