document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const typeSearchInput = document.getElementById('type-search');
    const cards = document.querySelectorAll('#pokemon-list .card');

    function filterCards() {
        const nameQuery = searchInput ? searchInput.value.trim().toLowerCase() : '';
        const typeQuery = typeSearchInput ? typeSearchInput.value.trim().toLowerCase() : '';

        cards.forEach((card) => {
            const name = (card.dataset.name || '').toLowerCase();
            const types = (card.dataset.types || '').toLowerCase();
            
            const matchesName = name.includes(nameQuery);
            const matchesType = types.includes(typeQuery);
            
            card.style.display = (matchesName && matchesType) ? '' : 'none';
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterCards);
    }

    if (typeSearchInput) {
        typeSearchInput.addEventListener('input', filterCards);
    }

    const allCards = document.querySelectorAll('.card');
    allCards.forEach(card => {
        card.addEventListener('click', function () {
            const pokemonName = this.querySelector('h2').textContent.toLowerCase();
            const basePath = window.location.pathname.includes('/pages/') ? '../' : '';
            window.location.href = `${basePath}components/info.php?name=${pokemonName}`;
        });
    });

    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('menu-overlay');
    const line1 = document.getElementById('line1');
    const line2 = document.getElementById('line2');
    const line3 = document.getElementById('line3');

    function toggleMenu() {
        if (!mobileMenu) return;

        mobileMenu.classList.toggle('translate-x-full');
        mobileMenu.classList.toggle('translate-x-0');

        if (overlay) {
            overlay.classList.toggle('opacity-0');
            overlay.classList.toggle('opacity-100');
            overlay.classList.toggle('pointer-events-none');
            overlay.classList.toggle('pointer-events-auto');
        }

        if (line1) {
            line1.classList.toggle('rotate-45');
            line1.classList.toggle('translate-y-2.5');
        }
        if (line2) {
            line2.classList.toggle('opacity-0');
            line2.classList.toggle('-translate-x-2');
        }
        if (line3) {
            line3.classList.toggle('-rotate-45');
            line3.classList.toggle('-translate-y-2.5');
        }

        document.body.classList.toggle('overflow-hidden');
    }

    if (burgerBtn) {
        burgerBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });
    }
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            e.preventDefault();
            toggleMenu();
        });
    }
});