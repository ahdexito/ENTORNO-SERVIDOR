const btn = document.querySelector('.dropdown-btn');
const content = document.querySelector('.dropdown-content');

btn.addEventListener('click', function() {
    content.classList.toggle('show');
    btn.classList.toggle('is-active'); // Añadimos esta línea
});