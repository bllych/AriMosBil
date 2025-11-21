const toggleDropdown = document.getElementById("toggleDropdown");
const dropdownMenu = document.getElementById("dropdownMenu");
const searchCountry = document.getElementById("searchCountry");
const countryList = document.getElementById("countryList");
const flagImg = document.querySelector(".flag");

// buka/tutup dropdown
toggleDropdown.addEventListener("click", () => {
  dropdownMenu.style.display =
    dropdownMenu.style.display === "block" ? "none" : "block";
});

// tutup dropdown kalau klik di luar
document.addEventListener("click", (e) => {
  if (!toggleDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.style.display = "none";
  }
});

// cari negara
searchCountry.addEventListener("keyup", () => {
  const filter = searchCountry.value.toLowerCase();
  const items = countryList.getElementsByTagName("li");
  for (let i = 0; i < items.length; i++) {
    const text = items[i].textContent.toLowerCase();
    items[i].style.display = text.includes(filter) ? "" : "none";
  }
});

// pilih negara
countryList.addEventListener("click", (e) => {
  const li = e.target.closest("li");
  if (li) {
    const img = li.querySelector("img").src;
    flagImg.src = img;
    dropdownMenu.style.display = "none";
  }
});
