<?php
require_once 'pdo.php';

class Pokemon {
    public $pokedex_number = 0;
    public $name = '';
    public $type_1 = '';
    public $type_2 = '';
    public $hp = 0;
    public $attack = 0;
    public $defense = 0;
    public $sp_attack = 0;
    public $sp_defense = 0;
    public $speed = 0;
    public $base_stat_total = 0;
    public $height_m = 0;
    public $weight_kg = 0;
    public $base_experience = 0;
    public $abilities = [];
    public $hidden_ability = '';
    public $generation = 0;
    public $is_legendary = false;
    public $is_mythical = false;
    public $is_baby = false;
    public $color = '';
    public $shape = '';
    public $egg_groups = '';
    public $habitat = '';
    public $growth_rate = '';
    public $capture_rate = '';
    public $base_happiness = '';
    public $genus = '';
    public $evolution_chain_id = 0;
    public $flavor_text = '';
    public $sprite_url = '';
    
    public $icon = '';
    public $types = [];
}

$pokemons = [];
$stmt = $pdo->query('SELECT * FROM pokemon_complete');

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pokemon = new Pokemon();
    
    foreach ($row as $key => $value) {
        if (property_exists($pokemon, $key)) {
            $pokemon->$key = $value;
        }
    }

    $pokemon->icon = $row['sprite_url'];
    $pokemon->types = array_filter([$row['type_1'], $row['type_2']]);
    
    $pokemons[] = $pokemon;
}

function getPokemons(){
    global $pokemons;
    return $pokemons;
}

function getPokemonByName($name){
    global $pokemons;
    foreach ($pokemons as $pokemon) {
        if (strtolower($pokemon->name) === strtolower($name)) {
            return $pokemon;
        }
    }
    return null;
}
?>