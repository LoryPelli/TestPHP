const img = document.querySelector('img');
img.addEventListener('error', () => {
    img.src = '/user.png';
});
