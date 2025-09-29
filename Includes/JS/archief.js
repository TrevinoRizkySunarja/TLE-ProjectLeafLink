window.addEventListener("load", init)

let page = 1;
let currentFilters = "";

function init() {
    localStorage.removeItem('selectedPlant');
    loadData("https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page, showData);
    loadHeaderTitle()

    document.getElementById("laadMeerKnop").addEventListener("click", loadNextPage);
    document.getElementById("lichtFilter").addEventListener("change", applyFilters);
    document.getElementById("waterFilter").addEventListener("change", applyFilters);
    document.getElementById("overigeFilter").addEventListener("change", applyFilters);
}

function loadData(url, successHandler) {
    fetch(url).then(response => {
        if(!response.ok){
            throw new Error(response.statusText);
        }
        return response.json();
    })
        .then(successHandler)
        .catch(errorHandler)
}

function errorHandler(error) {
    console.error(error)
}

function showData(data) {
    console.log(data)
    let list = document.getElementById("plantenLijst")
    data.data.forEach(plant => {
        let plantCard = document.createElement("div")
        let plantImageContainer = document.createElement("div")
        let plantAfbeelding = document.createElement("img")
        let plantNaam = document.createElement("p")

        // Als er een thumbnail image is, gebruik die, anders een placeholder
        if (plant.default_image && plant.default_image.thumbnail) {
            plantAfbeelding.src = plant.default_image.thumbnail;
        } else {
            plantAfbeelding.src = "../Includes/images/cactus1.png";
        }

        plantAfbeelding.alt = "Foto van " + plant.common_name;
        plantNaam.innerText = plant.common_name || "Naam onbekend";
        plantCard.classList.add("plant-card")
        plantImageContainer.classList.add("plant-card-container")
        plantCard.addEventListener("click", () => {
            console.log("Plant clicked:", plant);
            showPlantDetails(plant);
        });
        plantImageContainer.appendChild(plantAfbeelding)
        plantCard.appendChild(plantImageContainer)
        plantCard.appendChild(plantNaam)
        list.appendChild(plantCard)
    })
}

function loadNextPage() {
    page ++;
    let url = "https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page + currentFilters;
    loadData(url, showData);
}

function applyFilters() {
    let lichtValue = document.getElementById("lichtFilter").value;
    let waterValue = document.getElementById("waterFilter").value;
    let overigeValue = document.getElementById("overigeFilter").value;

    currentFilters = lichtValue + waterValue + overigeValue;
    console.log(currentFilters)
    page = 1;
    document.getElementById("plantenLijst").innerHTML = "";

    let url = "https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page + currentFilters;
    loadData(url, showData);
}

function loadHeaderTitle() {
    let h1 = document.getElementById("headerH1");
    h1.innerText = "Archief";
}

function showPlantDetails(plant) {
    localStorage.setItem("selectedPlant", plant.id);
    window.location.href = "../../detail.php";
}