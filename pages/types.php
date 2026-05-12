<?php
require '../utils/pdo.php';
include '../components/head.php';

class Type
{
    public $name = '';
    public $double_damage_to = [];
    public $half_damage_to = [];
    public $no_damage_to = [];
    public $double_damage_from = [];
    public $half_damage_from = [];
    public $no_damage_from = [];
}

function getTypeByName($name = '', &$types = [])
{
    foreach ($types as $type) {
        if (strtolower($type->name) === strtolower($name)) {
            return $type;
        }
    }
    return null;
}

global $pdo;
$types = [];

$rows = $pdo->query('SELECT * FROM pokemon_type')->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $type = new Type();
    $type->name = $row['type'];
    $types[] = $type;
}

foreach ($rows as $row) {
    $type = getTypeByName($row['type'], $types);
    if (!$type) continue;

    $relations = [
        'double_damage_to', 'half_damage_to', 'no_damage_to',
        'double_damage_from', 'half_damage_from', 'no_damage_from'
    ];

    foreach ($relations as $rel) {
        $list = $row[$rel] === '' ? [] : explode('|', $row[$rel]);
        foreach ($list as $value) {
            $foundType = getTypeByName($value, $types);
            if ($foundType) {
                $type->$rel[] = $foundType;
            }
        }
    }
}

$typeIds = [
    'normal' => 1, 'fighting' => 2, 'flying' => 3, 'poison' => 4, 'ground' => 5,
    'rock' => 6, 'bug' => 7, 'ghost' => 8, 'steel' => 9, 'fire' => 10,
    'water' => 11, 'grass' => 12, 'electric' => 13, 'psychic' => 14,
    'ice' => 15, 'dragon' => 16, 'dark' => 17, 'fairy' => 18,
];

$typeColors = [
    'normal' => '#A8A77A', 'fire' => '#EE8130', 'water' => '#6390F0', 'electric' => '#F7D02C',
    'grass' => '#7AC74C', 'ice' => '#96D9D6', 'fighting' => '#C22E28', 'poison' => '#A33EA1',
    'ground' => '#E2BF65', 'flying' => '#A98FF3', 'psychic' => '#F95587', 'bug' => '#A6B91A',
    'rock' => '#B6A136', 'ghost' => '#735797', 'dragon' => '#6F35FC', 'steel' => '#B7B7CE',
    'fairy' => '#D685AD', 'dark' => '#705746'
];

$renderBadge = function($list) use ($typeIds, $typeColors) {
    $items = array_filter($list);
    if (empty($items)) {
        return '<span class="text-gray-300 text-[10px] font-bold tracking-widest italic uppercase">Aucun</span>';
    }
    
    $html = '<div class="flex flex-wrap gap-2 mt-1">';
    foreach ($items as $t) {
        $name = strtolower($t->name);
        $color = $typeColors[$name] ?? '#CBD5E1';
        $id = $typeIds[$name] ?? 1;
        $label = ucfirst($name);
        
        $html .= "
        <div class='group/tooltip relative inline-flex items-center justify-center w-8 h-8 rounded-full shadow-sm border border-white/20 transition-transform hover:scale-110' 
             style='background-color: {$color}' 
             title='{$label}'>
            <img src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-vii/lets-go-pikachu-lets-go-eevee/small/{$id}.png' 
                 class='w-5 h-5 object-contain' alt='{$name}'>
        </div>";
    }
    $html .= '</div>';
    return $html;
};
?>

<body class="bg-slate-50 font-sans antialiased text-slate-900">
    <?php include '../components/header.php'; ?>

    <main class="max-w-7xl mx-auto py-12 px-6">
        <header class="mb-16 text-center">
            <h1 class="text-4xl font-black tracking-tight text-slate-900 sm:text-6xl mb-4">Table des Types</h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto font-medium">Guide stratégique des efficacités et faiblesses élémentaires.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($types as $type): 
                $typeName = strtolower($type->name);
                $accentColor = $typeColors[$typeName] ?? '#64748b';
                $id = $typeIds[$typeName] ?? 1;
            ?>
                <div class="group relative bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-200 hover:-translate-y-1">
                    <div class="h-3 w-full" style="background-color: <?= $accentColor ?>"></div>
                    
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-10">
                            <div>
                                <h2 class="text-3xl font-black text-slate-800"><?= ucfirst($type->name) ?></h2>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Pokémon Element</span>
                            </div>
                            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/types/generation-vii/lets-go-pikachu-lets-go-eevee/small/<?= $id ?>.png" 
                                     alt="<?= $type->name ?>" class="w-10 h-10 object-contain">
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="flex items-center text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">
                                <svg class="w-4 h-4 mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                                Offensive
                            </h3>
                            
                            <div class="space-y-5 pl-2 border-l-2 border-slate-100">
                                <div>
                                    <p class="text-[10px] font-black text-emerald-600 uppercase mb-1">Efficace (x2)</p>
                                    <?= $renderBadge($type->double_damage_to) ?>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-rose-400 uppercase mb-1">Réduit (x0.5)</p>
                                    <?= $renderBadge($type->half_damage_to) ?>
                                </div>
                                <?php if (!empty(array_filter($type->no_damage_to))): ?>
                                <div>
                                    <p class="text-[10px] font-black text-violet-600 uppercase mb-1">Pas d'effet (x0)</p>
                                    <?= $renderBadge($type->no_damage_to) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="my-6 border-t border-slate-50"></div>

                        <div>
                            <h3 class="flex items-center text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Défense
                            </h3>
                            
                            <div class="space-y-5 pl-2 border-l-2 border-slate-100">
                                <div>
                                    <p class="text-[10px] font-black text-rose-600 uppercase mb-1">Faiblesse (x2)</p>
                                    <?= $renderBadge($type->double_damage_from) ?>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-sky-500 uppercase mb-1">Résistance (x0.5)</p>
                                    <?= $renderBadge($type->half_damage_from) ?>
                                </div>
                                <?php if (!empty(array_filter($type->no_damage_from))): ?>
                                <div>
                                    <p class="text-[10px] font-black text-violet-600 uppercase mb-1">Immunité (x0)</p>
                                    <?= $renderBadge($type->no_damage_from) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>