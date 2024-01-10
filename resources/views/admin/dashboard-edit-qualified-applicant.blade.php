<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | AddQuestion </title>
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
            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Edit Applicant </h1>

                <div class="my-2">
                    <i class='bx bx-cog bx-sm text-[#8B8585]'></i>
                    <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                    <i class='bx bx-user-circle bx-sm text-[#8B8585]'></i>
                </div>

            </nav>

            <section class="ml-[218px]">

                <div
                    class=" w-6/12 right-0 mx-auto   translate-y-[-15px] transition-all transform  delay-150 ease-linear">
                    <form action="{{ route('admin.dashboard.update-qualified-applicant', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="bg-white mx-4 rounded-[12px] mt-4  h-[380px] p-4 border-gray-100 border-2">
                            <div
                                class="text-center mx-auto font-poppins text-[28px] font-semibold  text-[#26386A] uppercase">
                                <h1>Edit Information</h1>

                            </div>

                            <div class=" px-8 flex justify-between gap-4 mt-6 ">
                                <div class="relative   w-full">
                                    <input type="text" name="firstName"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                        placeholder="First Name" required autocomplete="off"
                                        value={{ $user->first_name }}>

                                </div>

                                <div class="relative  w-full">
                                    <input type="text" name="lastName"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                        placeholder="Last Name" required autocomplete="off"
                                        value={{ $user->last_name }}>

                                </div>



                            </div>


                            <div class="relative px-8 my-4 w-full">
                                <input type="text" name="email"
                                    class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                    placeholder="Email Address" required autocomplete="off" value="{{ $user->email }}">

                            </div>




                            <div class="relative px-8 my-4 w-full flex">
                                <div
                                    class="h-[50px] py-3 w-5/12 bg-white whitespace-nowrap placeholder:text-[#4E4E4E]  px-[40px] rounded-l   border-x-2 border-y-2 border-r-2 border-[#D7D8D0]">
                                    <label for="">Status</label>
                                </div>
                                <select name="status"
                                    class="h-[50px] w-full  placeholder:text-[#4E4E4E]  px-[40px] rounded-r border-y-2 border-r-2 border-[#D7D8D0]"
                                    autocomplete="off">
                                    <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                    <option value="Unqualified">Unqualified</option>
                                    <option value="Qualified">Qualified</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                </select>

                            </div>





                            <div class="px-8 my-6">
                                <input type="submit" value="Submit"
                                    class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">


                            </div>


                        </div>



                    </form>
                    @if ($errors->any())
                        <div class="text-red-900 my-8 my-4">
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

    </body>

</html>
