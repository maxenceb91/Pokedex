<?php
include 'components/head.php';
require_once 'utils/pokemon.php';
$pokemons = getPokemons();
?>

<body>
    <?php include 'components/header.php'; ?>
    <div class="p-6">
        <input type="text" id="search" placeholder="Search Pokémon..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <ul id="pokemon-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <?php foreach ($pokemons as $pokemon): ?>
            <li class="card bg-white rounded-lg shadow-md p-4 flex flex-col items-center hover:bg-gray-100 cursor-pointer hover:shadow-lg transition-shadow duration-300 hover:scale-105 transition-transform duration-300" data-name="<?php echo htmlspecialchars($pokemon->name, ENT_QUOTES, 'UTF-8'); ?>" data-types="<?php echo htmlspecialchars(implode(' ', array_filter($pokemon->types)), ENT_QUOTES, 'UTF-8'); ?>">
                <img class="w-40 h-40 object-contain" src="<?php echo $pokemon->icon; ?>" alt="<?php echo $pokemon->name; ?>">
                <div class="mt-4 w-full text-center">
                    <h2 class="text-lg font-bold text-gray-800 capitalize"><?php echo $pokemon->name; ?></h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Types: <?php echo implode(', ', array_filter($pokemon->types)); ?>
                    </p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>