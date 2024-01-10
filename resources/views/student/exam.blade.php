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
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}


    </head>

    <body>
        <div class="min-h-screen  mx-auto ">
            @include('layout.danger-alert')


            <nav class="h-[60px] flex justify-between mx-[40px]">

                <div class="w-[500px] flex justify-between items-center">
                    <div>
                        <h1 class=" text-[36px] font-raleway font-semibold"><span class="text-[#2217D0]">e</span>quali.
                        </h1>
                    </div>
                </div>

            </nav>
            <form id="form" action="{{ route('submit-exam') }}" method="POST" class="">
                <section class=" md:mr-[280px]">
                    <div class="">
                        <div class="md:w-full">
                            @if ($exam)
                                <div class="w-full">
                                    @csrf

                                    <div
                                        class="mx-4 w-auto md:mx-auto text-center md:w-[800px] relative border rounded-[12px] border-[#D2D2D2] shadow-md">
                                        <div
                                            class="absolute top-0 left-0 bg-[#2B6BE6] w-full h-4 mb-4 rounded-t-[12px]">
                                        </div>
                                        <div class="mx-4 my-1 ">
                                            <h1 class="pt-4 text-[28px] font-poppins text-left">Qualifying Exam</h1>
                                        </div>

                                        <hr class="border-[#D2D2D2]">
                                        <div class="mx-4 my-2 text-left ">
                                            <p class="text-[16px]">Name:
                                                {{ Auth()->user()->last_name . ',' . Auth()->user()->first_name }}</p>
                                            <p class="text-[16px]">Email: {{ Auth()->user()->email }}</p>
                                        </div>

                                    </div>





                                    {{-- <div class="mx-0 border-b-2 my-4"></div> --}}
                                    <div class="w-[9/12]">
                                        <div class=" mt-3 ">


                                            @foreach ($exam->examQuestion as $index => $examQuestion)
                                                <div id="question{{ $index + 1 }}"
                                                    class="mx-4 w-auto md:mx-auto text-center mt-4 pb-2 md:w-[800px] border rounded-[12px] border-[#D2D2D2] shadow-md ">

                                                    <div class="mx-4 my-1 text-left ">
                                                        <h1 class="text-[18px] font-poppins">
                                                            {{ $examQuestion->question->question_text }}
                                                        </h1>
                                                    </div>
                                                    <hr class="border-[#D2D2D2]">

                                                    @if ($examQuestion->question->image_path != null)
                                                        <div class="p-2">
                                                            <img class="w-full"
                                                                src="{{ asset('storage/questions/' . $examQuestion->question->image_path) }}"
                                                                alt="">
                                                        </div>
                                                    @endif

                                                    <hr class="border-[#D2D2D2]">
                                                    <div class="mx-4 my-1 text-left ">
                                                        <div class="flex my-1">
                                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                                name="answer[{{ $index + 1 }}]" id=""
                                                                value="{{ $examQuestion->question->choices->get(0)->id }}">
                                                            <p class="ml-2 py-1">
                                                                {{ $examQuestion->question->choices->get(0)->choice_text }}
                                                            </p>

                                                        </div>


                                                        <div class="flex my-1">


                                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                                name="answer[{{ $index + 1 }}]" id=""
                                                                value="{{ $examQuestion->question->choices->get(1)->id }}">
                                                            <p class="ml-2">
                                                                {{ $examQuestion->question->choices->get(1)->choice_text }}
                                                            </p>
                                                        </div>

                                                        <div class="flex my-1">

                                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                                name="answer[{{ $index + 1 }}]" id=""
                                                                value="{{ $examQuestion->question->choices->get(2)->id }}">
                                                            <p class="ml-2">
                                                                {{ $examQuestion->question->choices->get(2)->choice_text }}
                                                            </p>

                                                        </div>
                                                        <div class="flex my-1">
                                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                                name="answer[{{ $index + 1 }}]" id=""
                                                                value="{{ $examQuestion->question->choices->get(3)->id }}">
                                                            <p class="ml-2">
                                                                {{ $examQuestion->question->choices->get(3)->choice_text }}
                                                            </p>


                                                        </div>

                                                        <div class="hidden">
                                                            <input class="py-2 px-4 ml-2" type="radio" required
                                                                name="answer[{{ $index + 1 }}]"
                                                                id="noAnswer{{ $index + 1 }}"
                                                                value="{{ $examQuestion->question->choices->get(4)->id }}">

                                                        </div>

                                                    </div>

                                                </div>
                                        </div>


                                    </div>

                                </div>
                            @endforeach

                            <div class="relative">
                                <button type="submit" id="submitButton"
                                    class="absolute right-0 m-3 md:block lg:hidden  bg-[#2B6CE6] text-white p-2 px-8 rounded-lg hover:bg-[#134197]">Submit</button>
                            </div>
                        </div>
                    </div>


        </div>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="exam_id" value="{{ $exam->id }}">


        <script>
            document.getElementById('submitButton').addEventListener('click', function(event) {
                var confirmation = confirm('Are you sure you want to submit the form?');

                if (!confirmation) {
                    event.preventDefault(); // Prevent the form from submitting
                }
            });
        </script>
    @else
        <div>
            <h1 class="text-center text-black font-bold text-[48px]">No Exam Found</h1>
        </div>

        <div class="mx-auto text-center"><a href="{{ route('home') }}"
                class="text-center border-2 px-4 rounded-lg text-[24px]">Back</a></div>
        @endif
        </div>


        </div>

        </section>

        <section
            class="hidden md:block fixed top-0 right-0 w-[280px] h-screen border-l border-slate-300 bg-white border-r border-[#D9DBE3]">
            <div class="fixed bottom-0 right-0 m-4">
                <button type="submit" id="submitButton"
                    class="bg-[#2B6BE6] text-white p-2 px-8 rounded-lg hover:bg-[#134197]">Submit</button>
            </div>

            <div class="mt-8 mx-4">
                <h2 class="text-[#2B6BE6] font-poppins font-bold text-lg">Question Numbers</h2>
                <div class="grid grid-cols-5 gap-2 mt-4">
                    @foreach ($exam->examQuestion as $index => $examQuestion)
                        <div class="question-number text-center border border-slate-300 hover:bg-[#2B6BE6] hover:text-white hover:cursor-pointer"
                            data-question="{{ $index + 1 }}" onclick="scrollToQuestion({{ $index + 1 }})">
                            {{ $index + 1 }}
                        </div>
                    @endforeach
                </div>


            </div>


        </section>

        <script>
            // Function to scroll to the selected question
            function scrollToQuestion(questionNumber) {
                var questionElement = document.getElementById('question' + questionNumber);
                if (questionElement) {
                    questionElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        </script>


        </form>






        </div>

        <div class="">
            <div id="timerContainer"
                class="fixed left-16 bottom-4 bg-white p-2 border border-blue-500 rounded shadow cursor-pointer">
                <h1 id="timer" class="text-lg text-blue-500">Time: 01:00:00</h1>
            </div>

            <button id="toggleTimer"
                class="fixed left-4 bottom-6 bg-blue-500 text-white p-1 rounded shadow cursor-pointer">
                Hide
            </button>
        </div>



        </div>

        <script src="{{ asset('js/exam.js') }}"></script>



        <script>
            // Declare countdown in the global scope
            let countdown;

            // Set your exam duration in seconds
            let timer;

            // Check if the timer is stored in localStorage
            if (localStorage.getItem("timer")) {
                timer = parseInt(localStorage.getItem("timer"), 10);
            } else {
                timer = {{ $option->qualifying_timer }} * 60; // Set the default timer value
            }

            // Restore the timer when the page is loaded
            window.onload = function() {
                startTimer();
            };

            // Save the timer when the page is about to unload (refresh/close)
            window.onbeforeunload = function() {
                // Save the timer in localStorage instead of sessionStorage
                localStorage.setItem("timer", timer.toString());
            };

            document.getElementById("form").addEventListener("submit", function() {
                // Clear the timer value from localStorage when the form is submitted
                localStorage.removeItem("timer");

                // ... (any additional logic you may want to perform when the form is submitted)

                // Reset the timer
                resetTimer();
            });

            function startTimer() {


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

                        const numberOfQuestions = {{ $exam->examQuestion->count() }};

                        for (let i = 1; i <= numberOfQuestions; i++) {
                            const noAnswerRadio = document.querySelector(`input[name="answer[${i}]"][id="noAnswer${i}"]`);
                            const otherRadioChecked = document.querySelector(
                                `input[name="answer[${i}]"]:checked:not([id="noAnswer${i}"])`);

                            if (noAnswerRadio && !otherRadioChecked) {
                                noAnswerRadio.checked = true;
                                console.log(`Selected "No Answer" for question ${i}`);
                            } else {
                                console.log(
                                    `Could not find "No Answer" radio for question ${i} or another option already selected`);
                            }
                        }

                        localStorage.clear();
                        document.getElementById("form").submit();

                        // Reset the timer after submitting the form
                        resetTimer();

                    } else {
                        timer--;
                    }
                }

                countdown = setInterval(updateTimer, 1000);
            }

            function resetTimer() {
                // Clear the existing timer interval if it's running
                clearInterval(countdown);

                // Set your exam duration in seconds
                timer = {{ $option->qualifying_timer }} * 60; // Set the default timer value

                // Start the timer
                startTimer();
            }

            document.getElementById("toggleTimer").addEventListener("click", function() {
                const timerContainer = document.getElementById("timerContainer");
                const buttonText = document.getElementById("toggleTimer");

                timerContainer.classList.toggle("hidden");

                if (timerContainer.classList.contains("hidden")) {
                    buttonText.innerText = "Show";
                } else {
                    buttonText.innerText = "Hide";
                }
            });

            // Start the timer when the page is loaded
            startTimer();
        </script>




</html>




</body>

</html>
