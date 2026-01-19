const check = document.getElementById("activo");
const caja = document.getElementById("check-background");

check.addEventListener("change", () => {
    if (check.checked) {
        caja.style.backgroundColor = "#56ee50";
    }
    else {
        caja.style.backgroundColor = "#c42f2f";
    }
});
