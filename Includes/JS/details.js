window.addEventListener("load", init)

let selectedPlantId = localStorage.getItem('selectedPlant');

function init() {
    loadData("https://perenual.com/api/v2/species/details/" + selectedPlantId + "?key=sk-wuwj68d12c997cb4012512", showData);
    document.getElementById("returnButton").addEventListener("click", goBack);
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
    let plantImage = document.getElementById("plantImage");
    let plantName = document.getElementById("plantName");
    let plantScientificName = document.getElementById("plantScientificName");
    let plantDescription = document.getElementById("description");

    plantImage.src = data.default_image ? data.default_image.thumbnail : "../Includes/images/cactus1.png";
    plantName.innerText = data.common_name || "Plantnaam onbekend";
    plantScientificName.innerText = data.scientific_name || "Wetenschappelijke naam onbekend";
    plantDescription.innerText = data.description || "Geen beschrijving beschikbaar.";
}

function goBack() {
    window.location.href = "../../archief.php";
}