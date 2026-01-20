const check = document.getElementById("activo");
const caja = document.getElementById("check-background");

check.addEventListener("change", () => {
    if (check.checked) {
        caja.style.backgroundColor = "#0078d4";
    }
    else {
        caja.style.backgroundColor = "#fff";
    }
});
