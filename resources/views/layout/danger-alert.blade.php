<div class="relative flex justify-center items-center h-full">
    <div class="absolute text-center mx-auto mt-20 z-50" id="redalertContainer">
        @if ($errors->any())
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    @foreach ($errors->all() as $error)
                        <span class="font-medium">{{ $error }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>

                    <span class="font-medium">{{ session('error') }}</span>

                </div>
            </div>
        @endif


    </div>
</div>

<div class="relative flex justify-center items-center h-full">
    <div class="absolute text-center mx-auto mt-20 z-50" id="greenalertContainer">
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border-2 border-green-200"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
    </div>
</div>


<script>
    // Get the alert container element
    const alertContainer = document.getElementById('redalertContainer');

    // Function to fade out the alert over 5 seconds
    const fadeOutAlert = () => {
        let opacity = 1;
        const intervalId = setInterval(() => {
            if (opacity > 0) {
                opacity -= 0.2;
                alertContainer.style.opacity = opacity;
            } else {
                clearInterval(intervalId);
                alertContainer.style.display = 'none';
            }
        }, 500);
    };

    // Check if the alert container exists and set a timeout to call the fadeOutAlert function after 5 seconds
    if (alertContainer) {
        setTimeout(fadeOutAlert, 3000);
    }
</script>
<script>
    // Get the green alert container element
    const greenAlertContainer = document.getElementById('greenalertContainer');

    // Function to fade out the green alert over 5 seconds
    const fadeOutGreenAlert = () => {
        let opacity = 1;
        const intervalId = setInterval(() => {
            if (opacity > 0) {
                opacity -= 0.2;
                greenAlertContainer.style.opacity = opacity;
            } else {
                clearInterval(intervalId);
                greenAlertContainer.style.display = 'none';
            }
        }, 500);
    };

    // Check if the green alert container exists and set a timeout to call the fadeOutGreenAlert function after 5 seconds
    if (greenAlertContainer) {
        setTimeout(fadeOutGreenAlert, 3000);
    }
</script>
