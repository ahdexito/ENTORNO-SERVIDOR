const check = document.getElementById("checkbox");
const info = document.getElementById("checkbox-info");

check.addEventListener("change", () => {
    if (check.checked) {
        info.textContent = "Activado";
    }
    else {
        info.textContent = "Desactivado";
    }
});
