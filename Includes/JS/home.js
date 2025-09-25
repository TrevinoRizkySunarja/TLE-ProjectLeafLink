// import {openMenu, closeMenu} from "./menu";

document.addEventListener("click", (e) => clickHandler(e));
window.addEventListener("load", loadPage);

let popup = document.getElementById("PlantStatusSec");
let navList = document.getElementById("navList");

function loadPage() {
    let h1 = document.getElementById("headerH1");
    h1.innerText = "Home";
}

function clickHandler(e) {
    if (e.target.classList.contains("favoritePlant")) {
        openPopUp();
    } else if (e.target.classList.contains(("closeButton"))) {
        closePopUp();
    } else if (e.target.id === "navButton") {
        openMenu();
    } else if (e.target.id !== "navButton" && navList.classList.contains("open")) {
        closeMenu();
    }
}

function openPopUp() {
    popup.style.display = 'block';
}

function closePopUp() {
    popup.style.display = 'none';
}

function openMenu() {
    navList.classList.remove("close");
    navList.classList.add("open");
}

function closeMenu() {
    navList.classList.remove("open");
    navList.classList.add("close");
}