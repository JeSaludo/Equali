
let addApplicantContent = document.querySelector("#addApplicantContent");
let currentAddApplicantBtn = document.querySelector("#addApplicantBtn");
let applicantContent = document.querySelector("#applicantContent")

let icon =  document.querySelector("#icon");
let isActive = true



document.addEventListener("click", e =>{  
    
    if (e.target.closest("#addApplicantBtn") === currentAddApplicantBtn) {
        if(e.target.closest("#addApplicantBtn") ===null) return           
        else
        {           
            if(isActive)
            currentAddApplicantBtn.innerHTML  = "<i class='bx bx-arrow-back pr-2'></i> Back"
            else
            currentAddApplicantBtn.innerHTML  = "<i class='bx bx-plus-medical pr-2' ></i> Add Applicant"
        } 
        
        isActive = !isActive; 
        applicantContent.classList.toggle('blur-sm')
        addApplicantContent.classList.toggle('opacity-0');        
        addApplicantContent.classList.toggle('pointer-events-none');
        addApplicantContent.classList.toggle('translate-y-[-15px]');
      
       
    } else if (!addApplicantContent.contains(e.target)) {        
        addApplicantContent.classList.add('opacity-0');
        addApplicantContent.classList.add('pointer-events-none', 'translate-y-[-15px]');
        applicantContent.classList.remove('blur-sm')
        currentAddApplicantBtn.innerHTML  = "<i class='bx bx-plus-medical pr-2' ></i> Add Applicant"
      
    }
})








