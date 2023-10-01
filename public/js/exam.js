
let addExamContent = document.querySelector("#addExamContent");
let currrentAddExamBtn = document.querySelector("#addExamBtn");
let examContent = document.querySelector("#examContent")

let icon =  document.querySelector("#icon");
let isActive = true



document.addEventListener("click", e =>{  
    
    if (e.target.closest("#addExamBtn") === currrentAddExamBtn) {
        if(e.target.closest("#addExamBtn") ===null) return           
        else
        {           
            if(isActive)
            currrentAddExamBtn.innerHTML  = "BACK"
            else
            currrentAddExamBtn.innerHTML  = "CREATE"
        } 
        
        isActive = !isActive; 
        examContent.classList.toggle('blur-sm')
        addExamContent.classList.toggle('opacity-0');        
        addExamContent.classList.toggle('pointer-events-none');
        addExamContent.classList.toggle('translate-y-[-15px]');
      
       
    } else if (!addExamContent.contains(e.target)) {        
        addExamContent.classList.add('opacity-0');
        addExamContent.classList.add('pointer-events-none', 'translate-y-[-15px]');
        examContent.classList.remove('blur-sm')
        currrentAddExamBtn.innerHTML  = "CREATE"
      
    }
})








