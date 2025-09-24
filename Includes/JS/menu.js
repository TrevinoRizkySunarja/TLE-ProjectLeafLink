window.addEventListener("load", init);

let navList = document.getElementById("navList");

function init() {
    let menuButton = document.getElementById("navButton");
    menuButton.addEventListener("click", openMenu);
    document.addEventListener("click", (e) => clickHandler(e));
}

function clickHandler(e) {
    if (e.target.id === "navButton") {
        openMenu();
    } else if (e.target.id !== "navButton" && navList.classList.contains("open")) {
        closeMenu();
    }
}

export function openMenu() {
    navList.classList.remove("close");
    navList.classList.add("open");
}

export function closeMenu() {
    navList.classList.remove("open");
    navList.classList.add("close");
}