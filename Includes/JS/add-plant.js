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
        let wateringMap = {
            "Frequent": "frequent",
            "Average": "average",
            "Minimum": "minimum",
            "None": "none"
        };

        let mappedWatering = wateringMap[watering] || watering.toLowerCase();
        document.getElementById("watering").value = mappedWatering;
    }

    if (sunlight) {
        // Handle sunlight array - take first value and map it
        let sunlightMap = {
            "full sun": "full_sun",
            "part shade": "part_shade",
            "full shade": "full_shade",
            "part sun": "part_sun",
            "partial shade": "part_shade",
            "partial sun": "part_sun"
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