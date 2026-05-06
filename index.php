<?php 
include 'components/head.php';
require_once 'utils/pokemon.php';
$pokemons = getPokemons();
?>

<body>
    <?php include 'components/header.php'; ?>
    <ul>
        <?php foreach ($pokemons as $pokemon): ?>
            <li>
                <img src="<?php echo $pokemon->icon; ?>" alt="<?php echo $pokemon->name; ?>">
                <?php echo $pokemon->name; ?> - Types: <?php echo implode(', ', array_filter($pokemon->types)); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>