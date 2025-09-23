document.addEventListener("click", (e) => clickHandler(e));
// window.addEventListener("load", loadPage());

let popup = document.getElementById("PlantStatusSec");

// function loadPage() {
//     let h1 = document.getElementById("headerH1");
//     h1.innerText = "Home";
// }

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