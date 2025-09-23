document.addEventListener("click", (e) => clickHandler(e));

let popup = document.getElementById("PlantStatusSec");

function clickHandler(e) {
    if (e.target.classList.contains("favoritePlant")) {
        openPopUp();
    } else if (e.target.classList.contains(("close"))) {
        closePopUp();
    }
}

function openPopUp() {
    popup.style.display = 'block';
}

function closePopUp() {
    popup.style.display = 'none';
}