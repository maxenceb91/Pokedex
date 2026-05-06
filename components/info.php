<?php
include '../components/head.php';
require_once '../utils/pokemon.php';
$pokemon = getPokemonByName($_GET['name']);
?>

<body class="bg-gray-50 p-6">
    <p class="mb-6"><a href="../index.php" class="text-blue-600 hover:text-blue-800 font-semibold">« Retour à la liste</a></p>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800"><?php echo $pokemon->name; ?></h1>
        <ul class="space-y-4">
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Numéro Pokédex :</span> <span><?php echo $pokemon->pokedex_number; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Type 1 :</span> <span><?php echo $pokemon->type_1; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Type 2 :</span> <span><?php echo $pokemon->type_2; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">HP :</span> <span><?php echo $pokemon->hp; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Attaque :</span> <span><?php echo $pokemon->attack; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Défense :</span> <span><?php echo $pokemon->defense; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Attaque Spéciale :</span> <span><?php echo $pokemon->sp_attack; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Défense Spéciale :</span> <span><?php echo $pokemon->sp_defense; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Vitesse :</span> <span><?php echo $pokemon->speed; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Total des Stats de Base :</span> <span><?php echo $pokemon->base_stat_total; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Hauteur (m) :</span> <span><?php echo $pokemon->height_m; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Poids (kg) :</span> <span><?php echo $pokemon->weight_kg; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Expérience de Base :</span> <span><?php echo $pokemon->base_experience; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Capacités :</span> <span><?php echo $pokemon->abilities; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Capacité Cachée :</span> <span><?php echo $pokemon->hidden_ability; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Génération :</span> <span><?php echo $pokemon->generation; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Légendaire :</span> <span><?php echo $pokemon->is_legendary ? 'Oui' : 'Non'; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Mythique :</span> <span><?php echo $pokemon->is_mythical ? 'Oui' : 'Non'; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Bébé :</span> <span><?php echo $pokemon->is_baby ? 'Oui' : 'Non'; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Couleur :</span> <span><?php echo $pokemon->color; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Forme :</span> <span><?php echo $pokemon->shape; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Groupes d'œufs :</span> <span><?php echo $pokemon->egg_groups; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Habitat :</span> <span><?php echo $pokemon->habitat; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Taux de Croissance :</span> <span><?php echo $pokemon->growth_rate; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Taux de Capture :</span> <span><?php echo $pokemon->capture_rate; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Bonheur de Base :</span> <span><?php echo $pokemon->base_happiness; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">Genre :</span> <span><?php echo $pokemon->genus; ?></span></li>
            <li class="flex justify-between py-2 border-b border-gray-200"><span class="font-semibold text-gray-700">ID de la Chaîne d'Évolution :</span> <span><?php echo $pokemon->evolution_chain_id; ?></span></li>
            <li class="py-4"><span class="font-semibold text-gray-700">Description :</span>
                <p class="mt-2 text-gray-600"><?php echo $pokemon->flavor_text; ?></p>
            </li>
            <li class="py-4 text-center"><span class="font-semibold text-gray-700 block mb-2">Sprite :</span>
                <img src="<?php echo $pokemon->sprite_url; ?>" alt="<?php echo $pokemon->name; ?>" class="mx-auto w-50 h-50">
            </li>
        </ul>
    </div>
</body>