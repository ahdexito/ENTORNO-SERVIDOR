const btn = document.querySelector('.dropdown-btn');
const content = document.querySelector('.dropdown-content');

btn.addEventListener('click', function() {
    content.classList.toggle('show');
    btn.classList.toggle('is-active');
});

// const btn = document.querySelectorAll('.dropdown-btn');

// botones.forEach(btn => {
//     btn.addEventListener('click', function() {
//         const content = this.nextElementSibling;

//         content.classList.toggle('show');
//         this.classList.toggle('is-active');
//     })
// })