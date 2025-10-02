document.addEventListener("click", (e) => clickHandler(e));
window.addEventListener("load", () => {
    loadPage();
    loadFacts();

    // hide facts if popup is clicked
    popup = document.getElementById("PlantStatusSec");
    if (popup) {
        hideFacts();
    }
});

let popup = document.getElementById("PlantStatusSec");
let navList = document.getElementById("navList");
let plantFact = document.getElementById("plantFacts");

let facts = [];
let factIndex = 0;

let factsVisible = true;

function loadPage() {
    let h1 = document.getElementById("headerH1");
    h1.innerText = "Home";
}

function clickHandler(e) {
    if (e.target.classList.contains(("closeButton"))) {
        closePopUp();
    } else if (e.target.id === "navButton") {
        openMenu();
    } else if (e.target.id !== "navButton" && navList.classList.contains("open")) {
        closeMenu();
    }
}

// function openPopUp() {
//     popup.style.display = 'block';
//     hideFacts();   // hide facts when popup opens
// }

function closePopUp() {
    window.location.href = "index.php";
    showFacts();   
}

function openMenu() {
    navList.classList.remove("close");
    navList.classList.add("open");
}

function closeMenu() {
    navList.classList.remove("open");
    navList.classList.add("close");
}

function hideFacts() {
    factsVisible = false;
    if (plantFact) plantFact.style.display = "none";
}

function showFacts() {
    factsVisible = true;
    if (plantFact) plantFact.style.display = "block";
}

function loadFacts() {
    fetch('./Includes/JS/plantFeitjes.json')
        .then(response => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(addFactsToPage)
        .catch(error => console.log(error));
}

function addFactsToPage(data) {
    facts = data.data; 
    factIndex = 0;
    showFact(); 
    setInterval(showFact, 15000); // change value to change timer
}

function showFact() {
    if (facts.length === 0 || !factsVisible) return; // don’t update if hidden
    let fact = facts[factIndex];
    plantFact.innerHTML = `<h3>${fact.name}</h3><p>${fact.info}</p>`;
    factIndex = (factIndex + 1) % facts.length;
}
