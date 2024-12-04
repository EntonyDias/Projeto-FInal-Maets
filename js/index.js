
const menuBtn = document.querySelector('.menu-btn');
const menu = document.getElementById('menu');
const closeMenuBtn = document.getElementById('close-menu');

menuBtn.addEventListener('click', () => {
    menu.classList.toggle('active');
});

closeMenuBtn.addEventListener('click', () => {
    menu.classList.remove('active');
});