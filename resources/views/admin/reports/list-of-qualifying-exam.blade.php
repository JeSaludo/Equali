<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equali | Overview </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


</head>

<body>
    <div class="min-h-screen  bg-[#F7F7F7]">

        @include('layout.sidenav')

       <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

            <div class="flex items-center  ">
                <form method="get" action="{{route('admin.dashboard.report.qualifying-exam')}}" class="relative w-[300px]">
                    @csrf
                    <input type="text" name="searchTerm" placeholder="Search Here"   value="{{ request('searchTerm') }}" class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                    <i class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    </form>
            </div>
        
            <div class="my-2">
                <i class='bx bx-cog bx-sm text-[#8B8585]' ></i>
                <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
                <i class='bx bx-user-circle bx-sm text-[#8B8585]' ></i>
            </div>
         
        </nav>    
        <section class="ml-[218px] main ">

            <div class="mx-4 my-4">

                <div class="flex justify-between mx-4 my-2"> 
                    
                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway">Qualified Exam Reports</h1>
                      
                    
                  
                    <div>
                        <a href="{{route('export.qualified-exam-result')}}" class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                            Export Report
                        </a>
                    </div>
                </div>
                

                


                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">                    
                    <div class="overflow-x-auto">
                        <table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">ID</td>
                                    <td class="px-6 py-2">Applicant Name</td>
                                    <td class="px-6 py-2">Exam Average</td>
                                </tr>
                            </thead>
                    
                            <tbody class="text-center ">
                                @foreach ($results as $index => $result)
                                <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                    <td class="px-6 py-3">{{$result->user_id}}</td>
                                    <td class="px-6 py-3">{{$result->user->last_name . ", " . $result->user->first_name}}</td>
                                    <td class="px-6 py-3">{{$result->measure_c_score}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav class="bg-white border-t rounded-b-lg border-[#D9DBE3] w-full py-2 flex justify-start">
                            <a href="" class="text-[#626B7F] font-poppins px-4 py-2 border border-[#D9DBE3] hover:bg-[#e8e9ef] rounded-md mx-2">Previous</a>
                            <a href="" class="text-[#626B7F] font-poppins px-4 py-2 border border-[#D9DBE3] hover:bg-[#e8e9ef] rounded-md mx-2">Next</a>
                        </nav>
                        
                    </div>
                   
                </div>
              
            </div>
           
        </section>

    </div>




    {{-- <script>
        document.getElementById('filterLink').addEventListener('click', function (e) {
            e.stopPropagation();
            var dropdown = document.getElementById('filterDropdown');
            dropdown.classList.toggle('opacity-0');
            document.getElementById('filterLink').classList.toggle('bg-[#e8e9ef]');
            document.getElementById('filterLink').classList.toggle('border-[#D9DBE3]');
        });
    
        window.addEventListener('click', function (event) {
            var dropdown = document.getElementById('filterDropdown');
            if (!event.target.matches('#filterLink') && !dropdown.contains(event.target)) {
                if (!dropdown.classList.contains('opacity-0')) {
                    dropdown.classList.add('opacity-0');
                    document.getElementById('filterLink').classList.toggle('bg-[#e8e9ef]');
                    document.getElementById('filterLink').classList.toggle('border-[#D9DBE3]');
                }
            }
        });
    </script>--}}
   

 
    
    
</body>

</html>
