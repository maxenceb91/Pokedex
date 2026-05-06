document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const cards = document.querySelectorAll('#pokemon-list .card');

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim().toLowerCase();

            cards.forEach((card) => {
                const name = (card.dataset.name || '').toLowerCase();
                const types = (card.dataset.types || '').toLowerCase();
                card.style.display = (name.includes(query) || types.includes(query)) ? '' : 'none';
            });
        });
    }

    const allCards = document.querySelectorAll('.card');
    allCards.forEach(card => {
        card.addEventListener('click', function () {
            const pokemonName = this.querySelector('h2').textContent.toLowerCase();
            window.location.href = `components/info.php?name=${pokemonName}`;
        });
    });
});