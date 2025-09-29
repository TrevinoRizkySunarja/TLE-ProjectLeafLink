let navList = document.getElementById("navList");
document.addEventListener("click", (e) => clickHandler(e));

function clickHandler(e) {
    if (e.target.id === "navButton") {
        openMenu();
    } else if (e.target.id !== "navButton" && navList.classList.contains("open")) {
        closeMenu();
    }
}

function openMenu() {
    navList.classList.remove("close");
    navList.classList.add("open");
}

function closeMenu() {
    navList.classList.remove("open");
    navList.classList.add("close");
}