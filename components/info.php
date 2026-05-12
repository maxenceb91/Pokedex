<?php
include '../components/head.php';
require_once '../utils/pokemon.php';
$pokemon = getPokemonByName($_GET['name']);
?>

<body>
    <?php include 'header.php'; ?>

    <div class="bg-white min-h-screen p-6">
        <p class="mb-6">
            <a href="../index.php" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-red-600 text-white font-semibold shadow-md transition duration-200 hover:bg-red-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                ← Retour à la liste
            </a>
        </p>
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-white to-yellow-50 rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-red-600 p-8 text-white text-center">
                    <h1 class="text-5xl font-bold mb-2"><?php echo $pokemon->name; ?></h1>
                    <p class="text-lg opacity-90">#<?php echo str_pad($pokemon->pokedex_number, 3, '0', STR_PAD_LEFT); ?></p>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="flex justify-center items-center bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6">
                            <img src="<?php echo $pokemon->sprite_url; ?>" alt="<?php echo $pokemon->name; ?>" class="w-64 h-64 object-contain drop-shadow-lg">
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-green-50 to-amber-100 p-4 rounded-lg border-l-4 border-green-500">
                                <p class="text-sm text-gray-600">Type</p>
                                <p class="text-lg font-bold text-green-700"><?php echo $pokemon->type_1; ?><?php echo $pokemon->type_2 ? ' / ' . $pokemon->type_2 : ''; ?></p>
                            </div>
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-4 rounded-lg border-l-4 border-red-500">
                                <p class="text-sm text-gray-600">Genre</p>
                                <p class="text-lg font-bold text-red-700"><?php echo $pokemon->genus; ?></p>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border-l-4 border-blue-500">
                                <p class="text-sm text-gray-600">Génération</p>
                                <p class="text-lg font-bold text-blue-700"><?php echo $pokemon->generation; ?></p>
                            </div>
                            <div class="flex gap-2">
                                <?php if ($pokemon->is_legendary): ?><span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">✨ Légendaire</span><?php endif; ?>
                                <?php if ($pokemon->is_mythical): ?><span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">🌟 Mythique</span><?php endif; ?>
                                <?php if ($pokemon->is_baby): ?><span class="bg-pink-500 text-white px-3 py-1 rounded-full text-xs font-bold">👶 Bébé</span><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-gray-100 to-gray-50 p-6 rounded-xl mb-8">
                        <p class="text-sm text-gray-600 font-semibold mb-2">Description</p>
                        <p class="text-gray-700 leading-relaxed"><?php echo $pokemon->flavor_text; ?></p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">HP</span><span class="text-2xl font-bold text-red-500"><?php echo $pokemon->hp; ?></span></div>
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">Attaque</span><span class="text-2xl font-bold text-orange-500"><?php echo $pokemon->attack; ?></span></div>
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">Défense</span><span class="text-2xl font-bold text-blue-500"><?php echo $pokemon->defense; ?></span></div>
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">Att. Spé.</span><span class="text-2xl font-bold text-purple-500"><?php echo $pokemon->sp_attack; ?></span></div>
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">Déf. Spé.</span><span class="text-2xl font-bold text-green-500"><?php echo $pokemon->sp_defense; ?></span></div>
                        <div class="bg-white border border-gray-200 p-4 rounded-lg"><span class="block text-xs text-gray-500 font-semibold mb-1">Vitesse</span><span class="text-2xl font-bold text-yellow-500"><?php echo $pokemon->speed; ?></span></div>
                    </div>
                    <div class="bg-gradient-to-br from-indigo-50 via-blue-50 to-cyan-50 p-6 rounded-2xl mb-8 border border-indigo-100 shadow-sm">
                        <p class="text-sm text-indigo-700 font-bold mb-4 uppercase tracking-wide">Stats Complètes</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-sm">
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Numéro Pokédex</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->pokedex_number; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Type 1</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->type_1; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Type 2</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->type_2; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">HP</p>
                                <p class="font-bold text-red-500"><?php echo $pokemon->hp; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Attaque</p>
                                <p class="font-bold text-orange-500"><?php echo $pokemon->attack; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Défense</p>
                                <p class="font-bold text-blue-500"><?php echo $pokemon->defense; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Attaque Spéciale</p>
                                <p class="font-bold text-purple-500"><?php echo $pokemon->sp_attack; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Défense Spéciale</p>
                                <p class="font-bold text-green-500"><?php echo $pokemon->sp_defense; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Vitesse</p>
                                <p class="font-bold text-yellow-500"><?php echo $pokemon->speed; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Total Stats Base</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->base_stat_total; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Hauteur (m)</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->height_m; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Poids (kg)</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->weight_kg; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Expérience de Base</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->base_experience; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Capacités</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->abilities; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Capacité Cachée</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->hidden_ability; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Génération</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->generation; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Légendaire</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->is_legendary ? 'Oui' : 'Non'; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Mythique</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->is_mythical ? 'Oui' : 'Non'; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Bébé</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->is_baby ? 'Oui' : 'Non'; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Couleur</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->color; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Forme</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->shape; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Groupes d'œufs</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->egg_groups; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Habitat</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->habitat; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Taux de Croissance</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->growth_rate; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Taux de Capture</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->capture_rate; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Bonheur de Base</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->base_happiness; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">Genre</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->genus; ?></p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-3 rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-xs">ID Chaîne d'Évolution</p>
                                <p class="font-bold text-gray-800"><?php echo $pokemon->evolution_chain_id; ?></p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white/80 backdrop-blur p-4 rounded-xl border border-gray-100">
                            <p class="text-xs text-gray-500 mb-1">Description</p>
                            <p class="text-gray-700 leading-relaxed"><?php echo $pokemon->flavor_text; ?></p>
                        </div>

                        <div class="mt-4 bg-white/80 backdrop-blur p-4 rounded-xl border border-gray-100 text-center">
                            <p class="text-xs text-gray-500 mb-2">Sprite</p>
                            <img src="<?php echo $pokemon->sprite_url; ?>" alt="<?php echo $pokemon->name; ?>" class="mx-auto w-32 h-32 object-contain drop-shadow">
                        </div>
                    </div>
                </div>
</body>