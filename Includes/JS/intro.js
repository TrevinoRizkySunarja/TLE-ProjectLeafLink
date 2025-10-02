const steps = document.querySelectorAll(".step");
const dots = document.querySelectorAll(".dot");
const nextBtns = document.querySelectorAll(".nextbtn");

let currentStep = 0;

nextBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        // Hide current step
        steps[currentStep].style.display = "none";

        // Increment step
        currentStep++;

        // Show next step
        if (currentStep < steps.length) {
            steps[currentStep].style.display = "block";
        }

        // Update dots
        dots.forEach(dot => dot.classList.remove("active"));
        if (currentStep < dots.length) {
            dots[currentStep].classList.add("active");
        }
    });
});



document.getElementById("startBtn").addEventListener("click",() => {
    window.location.href = "login.php";
});