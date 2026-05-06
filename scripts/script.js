document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('click', function () {
            const pokemonName = this.querySelector('h2').textContent.toLowerCase();
            window.location.href = `components/info.php?name=${pokemonName}`;
        });
    });
});