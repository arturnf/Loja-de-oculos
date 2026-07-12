const imgMain = document.querySelector('.img-i');
const thumbButtons = document.querySelectorAll('.thumb-btn');

thumbButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const imageUrl = button.getAttribute('data-image');

        if (imgMain && imageUrl) {
            imgMain.src = imageUrl;
        }

        thumbButtons.forEach((item) => item.classList.remove('is-active'));
        button.classList.add('is-active');
    });
});