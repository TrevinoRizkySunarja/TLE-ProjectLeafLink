// import {openMenu, closeMenu} from "./menu";

document.addEventListener("click", (e) => clickHandler(e));
window.addEventListener("load", loadPage);

let popup = document.getElementById("PlantStatusSec");
let navList = document.getElementById("navList");

function loadPage() {
    let h1 = document.getElementById("headerH1");
    h1.innerText = "Nieuwe Plant";
    populateFormFromStorage();
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

function populateFormFromStorage() {
    let commonName = localStorage.getItem("plantToAdd_commonName");
    let watering = localStorage.getItem("plantToAdd_watering");
    let sunlight = localStorage.getItem("plantToAdd_sunlight");

    if (commonName) {
        document.getElementById("name").value = commonName;
    }

    if (watering) {
        document.getElementById("watering").value = watering;
        let wateringMap = {
            "Frequent": "Frequent",
            "Average": "Gemiddeld",
            "Minimum": "Minimaal",
            "None": "Geen"
        };

        let mappedWatering = wateringMap[watering] || watering.toLowerCase();
        document.getElementById("watering").value = mappedWatering;
    }

    if (sunlight) {
        document.getElementById("sunlight").value = sunlight;
        // Handle sunlight array - take first value and map it
        let sunlightMap = {
            "full sun": "Volle zonlicht",
            "part shade": "Halfschaduw",
            "full shade": "Volledige schaduw",
            "part sun": "Deels zonlicht",
            "partial shade": "Halfschaduw",
            "partial sun": "Deels zonlicht"
        };

        // If sunlight is a comma-separated string, take the first value
        let firstSunlight = sunlight.split(",")[0].trim().toLowerCase();
        let mappedSunlight = sunlightMap[firstSunlight] || firstSunlight.replace(/\s+/g, "_");
        document.getElementById("sunlight").value = mappedSunlight;
    }

    // Clear localStorage after populating
    localStorage.removeItem("plantToAdd_commonName");
    localStorage.removeItem("plantToAdd_watering");
    localStorage.removeItem("plantToAdd_sunlight");
}