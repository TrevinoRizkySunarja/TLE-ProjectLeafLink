window.addEventListener("load", init)

let page = 1;

function init() {
    loadData("https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page, showData);

    document.getElementById("laadMeerKnop").addEventListener("click", loadNextPage);
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
}

function loadNextPage() {
    page++;
    loadData("https://perenual.com/api/v2/species-list?key=sk-wuwj68d12c997cb4012512&page=" + page, showData)
}