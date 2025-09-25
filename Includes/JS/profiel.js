const input = document.getElementById('zoekInvoer');
const dropdown = document.getElementById('searchDropdown');

input.addEventListener('input', async () => {
    const term = input.value.trim();
    if (!term) {
        dropdown.innerHTML = '';
        return;
    }

    const res = await fetch(`profiel.php?search=${encodeURIComponent(term)}`);
    const plants = await res.json();

    dropdown.innerHTML = plants.map(name => `<div>${name}</div>`).join('');
});