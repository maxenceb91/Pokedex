<?php
require_once 'pdo.php';

class Pokemon {
    public $name = '';
    public $icon = '';
    public $types = [];
}

$pokemons = [];
$stmt = $pdo->query('SELECT name, sprite_url, type_1, type_2 FROM pokemon_complete');
while ($row = $stmt->fetch()) {
    $pokemon = new Pokemon();
    $pokemon->name = $row['name'];
    $pokemon->icon = $row['sprite_url'];
    $pokemon->types[] = $row['type_1'];
    $pokemon->types[] = $row['type_2'];
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