const rightFixedButtons = document.querySelectorAll('.right_fixed');

rightFixedButtons.forEach((button, index) => {
    button.style.top = `${index * 120 + 400}px`;
});
