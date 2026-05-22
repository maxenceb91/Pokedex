<?php
include 'components/head.php';
require_once 'utils/pokemon.php';
$pokemons = getPokemons();
?>

<body>
    <?php include 'components/header.php'; ?>
    <div class="p-6 flex flex-col sm:flex-row gap-4">
        <input type="text" id="search" placeholder="Search Pokémon..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
        <input type="text" id="type-search" placeholder="Search Types..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
    </div>
    <ul id="pokemon-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <?php foreach ($pokemons as $pokemon): ?>
            <li class="card relative bg-white border border-gray-100 rounded-2xl shadow-sm p-4 flex flex-col items-center cursor-pointer transition-all duration-300 ease-in-out transform hover:shadow-xl hover:-translate-y-2 hover:border-red-300 group" data-name="<?php echo htmlspecialchars($pokemon->name, ENT_QUOTES, 'UTF-8'); ?>" data-types="<?php echo htmlspecialchars(implode(' ', array_filter($pokemon->types)), ENT_QUOTES, 'UTF-8'); ?>">
                <div class="w-full flex justify-center bg-gray-50 rounded-xl p-4 transition-colors duration-300 group-hover:bg-red-50">
                    <img class="w-32 h-32 object-contain transition-transform duration-300 group-hover:scale-110" src="<?php echo $pokemon->icon; ?>" alt="<?php echo $pokemon->name; ?>">
                </div>
                <div class="mt-4 w-full text-center">
                    <h2 class="text-xl font-bold text-gray-800 capitalize tracking-wide"><?php echo $pokemon->name; ?></h2>
                    <div class="mt-3 flex flex-wrap justify-center gap-2">
                        <?php foreach (array_filter($pokemon->types) as $type): ?>
                            <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider text-gray-700 bg-gray-200 rounded-full shadow-sm">
                                <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>