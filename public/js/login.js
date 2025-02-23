document.addEventListener("DOMContentLoaded", function() {
    const body = document.querySelector(".background");
    const formWrapper = document.querySelector(".form-wrapper");
    const toggles = document.querySelectorAll(".toggle");

    toggles.forEach(toggle => {
        toggle.addEventListener("click", function() {
            const target = this.getAttribute("data-target");

            if (target === "register-form") {
                formWrapper.classList.add("move-left");
                body.classList.add("change-bg");
            } else {
                formWrapper.classList.remove("move-left");
                body.classList.remove("change-bg");
            }
        });
    });
});
