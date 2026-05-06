<?php
include 'components/head.php';
require_once 'utils/pokemon.php';
$pokemons = getPokemons();
?>

<body>
    <?php include 'components/header.php'; ?>
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <?php foreach ($pokemons as $pokemon): ?>
            <li class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
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