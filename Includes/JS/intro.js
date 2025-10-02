const steps = document.querySelectorAll(".step");
const dots = document.querySelectorAll(".dot");
const nextBtns = document.querySelectorAll(".nextbtn");
const backBtns = document.querySelectorAll(".backbtn");

let currentStep = 0;

nextBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        steps[currentStep].style.display = "none";
        currentStep++;
        steps[currentStep].style.display = "block";
        updateDots();
    });
});

backBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        steps[currentStep].style.display = "none";
        currentStep--;
        steps[currentStep].style.display = "block";
        updateDots();
    });
});

document.getElementById("startBtn").addEventListener("click", () => {
    window.location.href = "login.php";
});

function updateDots() {
    dots.forEach(dot => dot.classList.remove("active"));
    if (currentStep < dots.length) {
        dots[currentStep].classList.add("active");
    }
}