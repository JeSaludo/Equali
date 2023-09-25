<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | StudentExam </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
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

        <div class="w-full h-10 bg-[#E0DFE7] relative">
        <div class="w-1/3 h-full bg-[#E0DFE7] absolute top-0 left-0 flex items-center justify-center font-poppins font-semibold"><h1 class="text-[#2B6BE6]">Qualifying Exam</h1></div> 
            <div class="w-1/3 h-full bg-[#E0DFE7] absolute top-0 left-1/3 flex items-center justify-center font-poppins font-semibold"><h1 class="text-[#2B6BE6]">Time: 00:02:00 / 01:00:00</h1></div> 
            <div class="w-1/3 h-full bg-[#E0DFE7] absolute top-0 left-2/3 flex items-center justify-center font-poppins font-semibold"><h1 class="bg-[#2B6BE6] text-[#FFFFFF] px-2 py-2 rounded-md">Finish Test</h1></div> 
        </div>

        <div class="mx-[40px] mt-4">
        <h1 class="text-[#2B6BE6] text-2xl font-semibold">Question 1</h1>
        <p class="mt-2 font-poppins text-[#626B7F]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis aliquam ut porttitor leo a diam sollicitudin tempor.</p>
    </div>
    
    <div class="mt-4 w-[50%] border rounded-lg border-[#3e3d42] bg-[#F3F4F6]">
        <div class="px-4 py-1 flex items-center space-x-2">
            <input type="radio" id="choice1" name="choices" value="choice1" class="h-4 w-4 text-[#2B6BE6]">
            <label for="choice1" class="font-poppins text-[#626B7F]">convallis aenean et tortor at risus viverra adipiscing</label>
        </div>
        <div class="border-b border-[#626B7F] mt-2"></div>
        
        <div class="px-4 py-1 flex items-center space-x-2 mt-2">
            <input type="radio" id="choice2" name="choices" value="choice2" class="h-4 w-4 text-[#2B6BE6]">
            <label for="choice2" class="font-poppins text-[#626B7F]">convallis aenean et tortor at risus viverra adipiscing</label>
        </div>
        <div class="border-b border-[#626B7F] mt-2"></div>
        
        <div class="px-4 py-1 flex items-center space-x-2 mt-2">
            <input type="radio" id="choice3" name="choices" value="choice3" class="h-4 w-4 text-[#2B6BE6]">
            <label for="choice3" class="font-poppins text-[#626B7F]">convallis aenean et tortor at risus viverra adipiscing</label>
        </div>
        <div class="border-b border-[#626B7F] mt-2"></div>
        
        <div class="px-4 py-2 flex items-center space-x-2 mt-2">
            <input type="radio" id="choice4" name="choices" value="choice4" class="h-4 w-4 text-[#2B6BE6]">
            <label for="choice4" class="font-poppins text-[#626B7F]">convallis aenean et tortor at risus viverra adipiscing</label>
        </div>
        
    </div>

       
    </div>

    

</body>

</html>
