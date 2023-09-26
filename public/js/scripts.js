
let addQuestionContent = document.querySelector("#addQuestionContent");
let currentAddQuestionBtn = document.querySelector("#addQuestionBtn");
let questionContent = document.querySelector("#questionContent")

let icon =  document.querySelector("#icon");
let isActive = true



document.addEventListener("click", e =>{  
    
    if (e.target.closest("#addQuestionBtn") === currentAddQuestionBtn) {
        if(e.target.closest("#addQuestionBtn") ===null) return           
        else
        {
            questionContent.classList.toggle("blur-sm");
            if(isActive)
            currentAddQuestionBtn.innerHTML  = "<i class='bx bx-arrow-back pr-2'></i> Back"
            else
            currentAddQuestionBtn.innerHTML  = "<i class='bx bx-plus-medical pr-2' ></i> Add Question"
        } 
        
        isActive = !isActive; 
        questionContent.classList.toggle('blur-sm')
        addQuestionContent.classList.toggle('opacity-0');        
        addQuestionContent.classList.toggle('pointer-events-none');
        addQuestionContent.classList.toggle('translate-y-[-15px]');
        
       
    } else if (!addQuestionContent.contains(e.target)) {        
        addQuestionContent.classList.add('opacity-0');
        addQuestionContent.classList.add('pointer-events-none', 'translate-y-[-15px]');
        questionContent.classList.remove('blur-sm')
        currentAddQuestionBtn.innerHTML  = "<i class='bx bx-plus-medical pr-2' ></i> Add Question"
      
    }
})








