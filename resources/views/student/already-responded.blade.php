<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Exam Result </title>
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

            <nav class="h-[60px] flex justify-between mx-[40px]">

                <div class="w-[500px] flex justify-between items-center">
                    <div>
                        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.
                        </h1>
                    </div>

                </div>




                <div class=" flex justify-between items-center">
                    <div class="mr-[120px]">
                        <ul class="flex space-x-4 font-poppins font-normal  ">
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">Home</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">About</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">Resources</li>
                            <li class="text-28px hover:cursor-pointer hover:text-[#1363DF]">FAQs</li>
                        </ul>
                    </div>



                </div>
            </nav>

            <div class="flex justify-center  my-[70px]  w-full ">


                <div class=" w-6/12 ">
                    <div class="mx-auto text-center">
                        <h1 class="text-[36px] text-[#2F2E41]  font-open font-bold">You already responded to the exam
                        </h1>


                    </div>
                    <div class="my-8  flex justify-center  ">


                        <a href="{{ route('home') }}"
                            class="flex items-center justify-center text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                            Back</a>

                        <a
                            class="flex items-center justify-center text-lg font-poppins font-normal ml-2 w-full h-[50px] rounded-[18px] bg-transparent hover:bg-[#cccccc] transition-colors duration-200 border-[#cccccc] border-2">Learn
                            More</a>





                    </div>
                </div>


            </div>

        </div>
    </body>

</html>
