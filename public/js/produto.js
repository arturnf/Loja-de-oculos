let imgMain = document.querySelector('.img-i');
const img = document.querySelectorAll('.img');


img.forEach(img => {
    img.addEventListener('click', () => {
        imgMain.src = img.src;
    });
});