// script.js

const toggleButton = document.getElementById('toggleButton');
const navLinks = document.getElementById('navLinks');

toggleButton.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});
