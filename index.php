<?php 
require_once 'utils/pokemon.php';
$pokemons = getPokemons();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
</head>
<body>
    <h1>Pokédex</h1>
    <ul>
        <?php foreach ($pokemons as $pokemon): ?>
            <li>
                <img src="<?php echo $pokemon->icon; ?>" alt="<?php echo $pokemon->name; ?>">
                <?php echo $pokemon->name; ?> - Types: <?php echo implode(', ', array_filter($pokemon->types)); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>z