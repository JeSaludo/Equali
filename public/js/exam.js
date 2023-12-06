document.addEventListener("DOMContentLoaded", function () {
    // Check if choices are already stored in local storage
    const storedChoices = JSON.parse(localStorage.getItem("examChoices")) || {};

    // Populate the radio inputs with stored choices
    Object.keys(storedChoices).forEach((index) => {
        const choiceId = storedChoices[index];
        const radioInput = document.querySelector(
            `input[name="answer[${index}]"][value="${choiceId}"]`
        );
        if (radioInput) {
            radioInput.checked = true;
        }
    });

    // Listen for changes in radio inputs and update local storage
    document.querySelectorAll('input[type="radio"]').forEach((input) => {
        input.addEventListener("change", function () {
            const index = this.name.match(/\d+/)[0];
            storedChoices[index] = this.value;
            localStorage.setItem("examChoices", JSON.stringify(storedChoices));
        });
    });

    // Listen for form submission
    document
        .getElementById("form")
        .addEventListener("submit", function (event) {
            // Disable the submit button
            const submitButton = document.getElementById("submitBtn");
            if (submitButton) {
                submitButton.disabled = true;
            }

            // Additional logic or form submission code goes here...

            // Clear 'examChoices' from local storage
            localStorage.removeItem("examChoices");

            // Prevent the default form submission behavior
        });
});
