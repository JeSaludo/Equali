const navLinks = document.querySelectorAll(".nav-link");

// Add click event listener to each nav link
navLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        // Remove the 'active' class from all links
        navLinks.forEach((otherLink) => {
            otherLink.classList.remove("active");
        });

        // Add the 'active' class to the clicked link
        link.classList.add("active");
    });
});
