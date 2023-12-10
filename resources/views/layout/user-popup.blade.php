<div class="my-2 flex items-center">
                

    <div class="my-2 flex items-center">
         {{-- <i class='bx bx-cog bx-sm text-[#8B8585]'></i> --}}
        <i class='bx bx-bell text-[#8B8585] bx-sm'></i>
        <i id="openPopupUser" class='hover:cursor-pointer bx bxs-user-circle bx-sm text-[#617388] hover:text-blue-600 focus:z-10 focus:ring-2 focus:ring-blue-600 focus:text-blue-600'></i>
            
    </div>
</div>

<script>
    document.getElementById('openPopupUser').addEventListener('click', () => {
        const popupContent = document.getElementById('popupContentlogin');
        if (popupContent.classList.contains('hidden')) {
            popupContent.classList.remove('hidden');
        } else {
            popupContent.classList.add('hidden');
        }
    });
</script>