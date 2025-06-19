// JavaScript for NeoOtaku Store card flip and other interactions
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-item');

    productCards.forEach(card => {
        const cardInner = card.querySelector('.product-card-inner');
        const detailsButton = card.querySelector('.details-button');
        const backButton = card.querySelector('.back-button');

        if (cardInner && detailsButton) {
            detailsButton.addEventListener('click', (event) => { // Added event param
                event.stopPropagation(); // Prevent event bubbling if card itself is clickable later
                cardInner.classList.toggle('is-flipped');
            });
        }

        if (cardInner && backButton) {
            backButton.addEventListener('click', (event) => { // Added event param
                event.stopPropagation(); // Prevent event bubbling
                cardInner.classList.toggle('is-flipped');
            });
        }
    });
});
