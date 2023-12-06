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
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
</head>

<body>
    <div class="min-h-screen w-[1440px] mx-auto ">

        <div class="flex justify-between">
            <div class="w-full">
                <nav class="h-[60px] flex justify-between mx-[40px]">

                    <div class="w-[500px] flex justify-between items-center">
                        <div>
                            <h1 class=" text-[36px] font-raleway font-semibold"><span
                                    class="text-[#2217D0]">e</span>quali.
                            </h1>
                        </div>
                    </div>

                </nav>

                
                @if($exam)
                    <form id="form" action="{{ route('submit-exam') }}" method="POST" class=" mt-4">
                        <div class="w-full">
                            @csrf
                            <div class="mx-16">
                                <div class="w-full  h-10 bg-white rounded-lg flex justify-between">
                                    <div class="p-2 ">
                                        <h1 class="text-[#2B6BE6] font-poppins font-bold text-lg">Qualifying Exam</h1>
                                    </div>
                                    
                                    
    
    
                                </div>
    
    
                            </div>
    
                            <div class=" mt-3">
    
                               
                                @foreach ($exam->examQuestion as $index => $examQuestion)
                                <div class="mx-16">
                                    
    
                                    <p class="text-[#626B7F]">
                                    <div>

                                        <h2>{{ $index + 1 }}. {{ $examQuestion->question->question_text }}</h2>
                                        @if ($examQuestion->question->image_path != null)
                                        <img class="w-3/12 p-4" src="{{"storage/questions/" . $examQuestion->question->image_path }}" alt="">
                                        
                                        @endif
                                     </div>
                                    
                                    </p>
                                    <div>
                                        <div class="border-t-2 border-x-2 rounded-t-lg flex  w-6/12  items-center">
                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                name="answer[{{ $index + 1 }}]" id=""
                                                value="{{ $examQuestion->question->choices->get(0)->id }}">
                                            <p class="ml-2 py-1">
                                                {{ $examQuestion->question->choices->get(0)->choice_text }}
                                            </p>
                                        </div>
                                        <div class="border-x-2 border-t-2 flex w-6/12  items-center">
                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                name="answer[{{ $index + 1 }}]" id=""
                                                value="{{ $examQuestion->question->choices->get(1)->id }}">
                                            <p class="ml-2">
                                                {{ $examQuestion->question->choices->get(1)->choice_text }}</p>
                                        </div>
                                        <div class="border-x-2 border-t-2 flex w-6/12  items-center">
                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                name="answer[{{ $index + 1 }}]" id=""
                                                value="{{ $examQuestion->question->choices->get(2)->id }}">
                                            <p class="ml-2">
                                                {{ $examQuestion->question->choices->get(2)->choice_text }}</p>
                                        </div>
                                        <div class="border-2 rounded-b-lg flex  w-6/12  items-center">
                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                name="answer[{{ $index + 1 }}]" id=""
                                                value="{{ $examQuestion->question->choices->get(3)->id }}">
                                            <p class="ml-2">
                                                {{ $examQuestion->question->choices->get(3)->choice_text }}</p>
                                        </div>

                                        <div class="hidden">
                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                name="answer[{{ $index + 1 }}]"   id="noAnswer{{ $index + 1 }}"
                                                value="{{ $examQuestion->question->choices->get(4)->id }}">
                                           
                                        </div>
                                    </div>
                                </div>
    
                                <div class="mx-0 border-b-2 my-4"></div>
                                @endforeach
                               
                             
                            </div>
    
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <div class="flex justify-end my-3">
                            <button type="submit"
                                class="bg-[#2B6CE6] text-white p-2 px-8 rounded-lg hover:bg-[#134197]">Submit</button>
                        </div>
                    </form>
                
                @else
                <div><h1 class="text-center text-black font-bold text-[48px]">No Exam Found</h1></div>

                <div class="mx-auto text-center"><a href="{{route('home')}}" class="text-center border-2 px-4 rounded-lg text-[24px]">Back</a></div>

                 @endif
               
            </div>
        </div>
        <div>

        </div>
        
        <div class="">
            <div id="timerContainer" class="fixed left-16 bottom-4 bg-white p-2 border border-blue-500 rounded shadow cursor-pointer">
                <h1 id="timer" class="text-lg text-blue-500">Time: 01:00:00</h1>
            </div>
            
            <button id="toggleTimer" class="fixed left-4 bottom-6 bg-blue-500 text-white p-1 rounded shadow cursor-pointer">
                Hide
            </button>
        </div>
        
        
        
    </div>

    <script src="{{asset('js/exam.js')}}"></script>
    <script>
      

    
        
        // const radioInputs = document.querySelectorAll('input[type="radio"]');
        // radioInputs.forEach(input => {
        //     input.addEventListener('change', () => {
        //         sessionStorage.setItem(input.name, input.value);
        //     });
        // });



        
        // radioInputs.forEach(input => {
        //     const savedValue = sessionStorage.getItem(input.name);
        //     if (savedValue) {
        //         if (input.value === savedValue) {
        //             input.checked = true;
        //         }
        //     }
        // });

        // const form = document.querySelector('form');
        // form.addEventListener('submit', () => {
            
        //     sessionStorage.clear();
        // });
   
        document.getElementById("toggleTimer").addEventListener("click", function () {
            const timerContainer = document.getElementById("timerContainer");
            const buttonText = document.getElementById("toggleTimer");

            timerContainer.classList.toggle("hidden");

            if (timerContainer.classList.contains("hidden")) {
                buttonText.innerText = "Show";
            } else {
                buttonText.innerText = "Hide";
            }
        });
        // Set your exam duration in seconds
        let timer = 10 // 1 hour in seconds
        let countdown = setInterval(updateTimer, 1000);

        function updateTimer() {
            let hours = Math.floor(timer / 3600);
            let minutes = Math.floor((timer % 3600) / 60);
            let seconds = timer % 60;

            // Add leading zeros if needed
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            // Update the UI
            document.getElementById("timer").innerText = `Time: ${hours}:${minutes}:${seconds}`;

            // Check if the timer has reached zero
            if (timer <= 0) {
                clearInterval(countdown);
              
                const numberOfQuestions = {{$exam->examQuestion->count()}};
                
                for (let i = 1; i <= numberOfQuestions; i++) {
                const noAnswerRadio = document.querySelector(`input[name="answer[${i}]"][id="noAnswer${i}"]`);
                const otherRadioChecked = document.querySelector(`input[name="answer[${i}]"]:checked:not([id="noAnswer${i}"])`);

                    if (noAnswerRadio && !otherRadioChecked) {
                        noAnswerRadio.checked = true;
                        console.log(`Selected "No Answer" for question ${i}`);
                    } else {
                        console.log(`Could not find "No Answer" radio for question ${i} or another option already selected`);
                    }
                }

                sessionStorage.clear();
                document.getElementById("form").submit();

            
            
                
            } else {
                timer--;
            }
        }

   

    </script>





</html>




</body>

</html>
