<!DOCTYPE html>
<html lang="en">

    <head>

        @section('header')
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Equali - @yield('title')</title>
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
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

        @show


    </head>

    <body>
        @section('sidebar')
            @include('layouts.sidebar')
        @show

        @section('navigation')

            <nav class="mx-auto sm:ml-64 flex justify-between  border-b border-[#D9DBE3] h-[60px] bg-white px-4">


                <div class="w-full flex items-center">

                    <a href="#" id="menuButton" class="sm:hidden"><i class='bx bx-sm bx-menu text-gray-500'></i></a>

                    <form class="hidden sm:block w-[250px] sm:w-[250px]" method="get" action="@yield('route')">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="searchTerm" value="{{ $searchTerm ?? '' }}"
                                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Search Here">
                            <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>

                        </div>


                    </form>
                </div>

                <div class=" flex justify-between items-center md:block gap-4 ">
                    <div class="w-[250px] sm:hidden ">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="searchTerm" value="{{ $searchTerm ?? '' }}"
                                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Search Here">
                            <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>

                        </div>
                    </div>

                    @include('layout.user-popup')


                </div>

            </nav>

        @show

        @section('scripts')

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var sidebar = document.getElementById("sidebar");
                    var menuButton = document.getElementById("menuButton");
                    var exitButton = document.getElementById("exitButton");

                    // Toggle sidebar visibility
                    function toggleSidebar() {
                        sidebar.classList.toggle("translate-x-[-260px]");
                        sidebar.classList.toggle("opacity-0");
                        sidebar.classList.toggle('bg-white');
                    }

                    // Event listener for menu button
                    menuButton.addEventListener("click", function(event) {
                        event.preventDefault();
                        console.log("Menu button clicked");
                        toggleSidebar();
                    });

                    // Event listener for exit button
                    exitButton.addEventListener("click", function(event) {
                        event.preventDefault();
                        console.log("Exit button clicked");
                        toggleSidebar();
                    });
                });
            </script>


            <script src="{{ asset('js/dropdown.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        @show

    </body>

</html>
