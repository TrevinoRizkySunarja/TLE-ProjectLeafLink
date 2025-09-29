window.addEventListener("load", init);

function init() {
    populateFormFromStorage();
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
    }

    if (sunlight) {
        document.getElementById("sunlight").value = sunlight;
    }

    // Clear localStorage after populating
    localStorage.removeItem("plantToAdd_commonName");
    localStorage.removeItem("plantToAdd_watering");
    localStorage.removeItem("plantToAdd_sunlight");
}