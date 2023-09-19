document.addEventListener("click", e => {
    const isDropdownButton = e.target.matches("[data-dropdown-button]")
    if (!isDropdownButton && e.target.closest("[data-dropdown]") != null) return
  
    let currentDropdown
    if (isDropdownButton) {
      currentDropdown = e.target.closest("[data-dropdown]")      
      currentDropdown.classList.toggle("active")
      
      const caretIcon = currentDropdown.querySelector(".caret-icon");
      caretIcon.classList.toggle("bx-rotate-90");
    }
  
    document.querySelectorAll("[data-dropdown].active").forEach(dropdown => {
      if (dropdown === currentDropdown) return
       dropdown.classList.remove("active")
       caretIcon = dropdown.querySelector(".caret-icon");
       caretIcon.classList.remove("bx-rotate-90");
    })
  })

