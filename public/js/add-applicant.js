document.getElementById("addApplicantBtn").addEventListener("click", () => {
    document.getElementById("addApplicantContent").classList.remove("hidden");
});

document.getElementById("closePopup").addEventListener("click", () => {
    document.getElementById("addApplicantContent").classList.toggle("hidden");
});
