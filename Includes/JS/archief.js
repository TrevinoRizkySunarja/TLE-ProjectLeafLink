window.addEventListener("load", init)

let page = 1;
let filter = "none";

function init() {
    loadData("https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page, showData);
    loadHeaderTitle()

    document.getElementById("laadMeerKnop").addEventListener("click", () => loadNextPage(filter));
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
        let plantAfbeelding = document.createElement("img")

        // Als er een thumbnail image is, gebruik die, anders een placeholder
        if (plant.default_image && plant.default_image.thumbnail) {
            plantAfbeelding.src = plant.default_image.thumbnail;
        } else {
            plantAfbeelding.src = "../Includes/images/cactus1.png";
        }

        plantAfbeelding.alt = "Foto van " + plant.common_name;
        plantCard.classList.add("plant-card")
        plantCard.addEventListener("click", () => {
            console.log("Plant clicked:", plant);
            // showPlantDetails(plant);
        });
        plantCard.appendChild(plantAfbeelding)
        list.appendChild(plantCard)
    })
}

function loadNextPage(filterValue) {
    if (filterValue === "none") {
        page++;
        loadData("https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page, showData)
    }
}

function loadHeaderTitle() {
    let h1 = document.getElementById("headerH1");
    h1.innerText = "Archief";
}

function showPlantDetails(plant) {
    // Hier kun je de logica toevoegen om meer details van de plant weer te geven
}