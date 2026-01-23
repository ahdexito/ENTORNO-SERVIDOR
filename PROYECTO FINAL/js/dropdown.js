const botones = document.querySelectorAll('.dropdown-btn');

botones.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();

        const content = this.nextElementSibling;

        document.querySelectorAll('.dropdown-content.show').forEach(openContent => {
            if (openContent !== content) {
                openContent.classList.remove('show');
                openContent.previousElementSibling.classList.remove('is-active');
            }
        });

        content.classList.toggle('show');
        this.classList.toggle('is-active');
    });
});

window.addEventListener('click', function() {
    document.querySelectorAll('.dropdown-content.show').forEach(openContent => {
        openContent.classList.remove('show');
    });

    document.querySelectorAll('.dropdown-btn.is-active').forEach(activeBtn => {
        activeBtn.classList.remove('is-active');
    });
});