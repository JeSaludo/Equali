<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Question </title>
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
        <script src="https://unpkg.com/cropperjs/dist/cropper.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7] ">

            @include('layout.danger-alert')



            @include('layouts.sidebar')

            @include('layouts.navigation', [
                'route' => null,
                'show' => false,
            ])

            <section class="sm:ml-64 main">

                @include('layout.popup')




                <div id="popup-modal" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 bottom-0 left-0 z-50 flex items-center justify-center">
                    <div class="relative p-4 w-full max-w-md mx-auto max-h-full">
                        <div class="relative bg-white rounded-lg shadow ">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Cannot add
                                    duplicate question</h3>
                                <button data-modal-hide="popup-modal" type="button"
                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Ok
                                </button>

                            </div>
                        </div>
                    </div>
                </div>





                <div class="w-full mx-auto mt-4">
                    <form id="form" action="{{ route('admin.dashboard.store-question') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white mx-4 rounded-[12px]  h-[500] p-4 border-2 border-gray-500 relative">
                            <div class="absolute  z-80 m-2">

                                <a id="openPopup" class="hover:cursor-pointer"><i
                                        class='bx bx-image-add bx-sm text-white '></i></a>
                            </div>

                            <div class="bg-[#4c4a67] h-[250px]  rounded-[8px] flex justify-between p-4">

                                <div id="preview"
                                    class="w-1/4 hidden py-4 ml-[16px] rounded-xl items-center bg-[#28273a] mt-8">
                                    <img id="imagePreview" class="hidden mx-auto text-center" alt="Image Preview"
                                        style="max-width: 100%; max-height: 160px;">

                                </div>

                                <div class="w-full m-4 mt-12 flex items-center">
                                    <textarea
                                        class="bg-transparent text-[28px] mx-auto text-center  flex items-center  py-8 w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Question Here" name="question_text" required autocomplete="off" style="resize: none;"></textarea>
                                </div>

                            </div>

                            <div class="h-[163px] my-7 flex justify-evenly gap-4 ">
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Choice Here" name="choice_text[]" required autocomplete="off">
                                    <div>
                                        <input
                                            class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 "
                                            type="radio" name="correct_choice" value="1" checked />
                                    </div>

                                </div>
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Choice Here" name="choice_text[]" required required
                                        autocomplete="off">
                                    <div>
                                        <input
                                            class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300"
                                            type="radio" name="correct_choice" value="2" />
                                    </div>
                                </div>
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Choice Here" name="choice_text[]" required required
                                        autocomplete="off">
                                    <div>
                                        <input
                                            class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300"
                                            type="radio" name="correct_choice" value="3" />
                                    </div>
                                </div>
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Choice Here" name="choice_text[]" required required
                                        autocomplete="off">
                                    <div>
                                        <input
                                            class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300"
                                            type="radio" name="correct_choice" value="4" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end w-full">
                                <div class="w-2/12">
                                    <input type="submit" value="Save Question"
                                        class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>

                            </div>



                        </div>




                    </form>
                    @if ($errors->any())
                        <div class="text-red-900">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>




            </section>





        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('imageInput');
                const imagePreview = document.getElementById('imagePreview');

                imageInput.addEventListener('change', function() {
                    const file = imageInput.files[0];

                    if (file) {
                        const reader = new FileReader();


                        const fileSizeLimit = 10 * 1024 * 1024; // 10MB in bytes
                        if (file.size > fileSizeLimit) {
                            alert('File size exceeds the limit. Please choose a smaller file.');
                            document.getElementById('form').reset();
                            return;
                        }

                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            document.getElementById("preview").classList.remove("hidden");
                            document.getElementById("preview").classList.add("flex");

                            document.getElementById("popup").classList.add("hidden");
                        };

                        reader.readAsDataURL(file);
                    } else {

                        imagePreview.src = '';
                        imagePreview.classList.add('hidden');
                    }
                });

            });

            let imgPreview = document.getElementById("preview")

            document.getElementById('openPopup').onclick = () => {
                document.getElementById("popup").classList.remove("hidden");
            }
            document.getElementById("back").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });
        </script>
        <script>
            $(document).ready(function() {
                var delayTimer;

                // Listen for changes in the input fields with name "choice_text[]"
                $('input[name^="choice_text"]').on('input', function() {
                    clearTimeout(delayTimer);

                    // Get the current input value
                    var currentInput = $(this).val();
                    var $currentInputField = $(this);

                    // Set a delay (e.g., 500 milliseconds) before checking for duplicates
                    delayTimer = setTimeout(function() {
                        // Flag to track if a duplicate is found
                        var duplicateFound = false;

                        // Loop through all other input fields
                        $('input[name^="choice_text"]').not($currentInputField).each(function() {
                            // Compare with the current input value
                            if ($(this).val() === currentInput) {
                                // Set the flag if a duplicate is found
                                duplicateFound = true;
                            }
                        });

                        // If a duplicate is found, remove the current input field
                        if (duplicateFound) {
                            showModal();
                            $currentInputField.val('');
                        }
                    }, 500); // Adjust the delay time as needed
                });

                // Function to show the popup modal
                function showModal() {
                    // Show the modal by adding the "hidden" class
                    $('#popup-modal').removeClass('hidden');

                    // Add event listeners to handle actions on the modal
                    $('[data-modal-hide="popup-modal"]').on('click', function() {
                        // Hide the modal
                        $('#popup-modal').addClass('hidden');
                    });

                    // Add additional actions as needed for the "Yes, I'm sure" button
                    // ...

                    // Add additional actions as needed for the "No, cancel" button
                    // ...
                }
            });
        </script>




    </body>

</html>
