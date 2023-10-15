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
                <div class="mx-auto">
                    <h1 class="pt-8 font-bold font-poppins text-xl text-center uppercase">Summary</h1>
                    <div class="mx-8">
                        <h2 class="uppercase font-bold font-poppins">Your Score:</h2>
                    </div>
                    <div>
                        <h1 class="my-11 font-bold font-poppins text-5xl text-center uppercase">70/100</h1>
                    </div>
                    <div>
                        <h1 class="text-[#2CCAAA] font-bold font-poppins text-5xl text-center uppercase">passed</h1>
                    </div>
                    <div>
                        <a class="mx-[215px] font-poppins text-center uppercase font-bold" href="">back</a>
                    </div>
                </div>




            </div>
            <div class="relative mt-[171px]">
                <img class="absolute bottom-0 left-0" src="{{ asset('img/Programming-v2.png') }}" alt="">
                <img class="absolute bottom-0 right-0" src="{{ asset('img/reading-v2.png') }}" alt="">

            </div>

        </div>





    </div>

</body>

</html>
