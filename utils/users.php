<?php
require_once 'pdo.php';

class User {
    public $id = 0;
    public $username = '';
    public $email = '';
    public $password_hash = ''; 
    public $icon_url = '';
    public $created_at = '';

    function getIcon() {
        return $this->icon_url ?: '../assets/default.jpg';
    }

    function save() {
        global $pdo;
        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, password_hash = ?, icon_url = ? WHERE id = ?');
            $stmt->execute([$this->username, $this->email, $this->password_hash, $this->icon_url, $this->id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash, icon_url) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->username, $this->email, $this->password_hash, $this->icon_url]);
            $this->id = $pdo->lastInsertId();
        }
    }
}

class Team {
    public $id = 0;
    public $user_id = 0;
    public $pokemon_list = '';
}

function addUser($username = '', $email = '', $password = '') {
    $user = new User();
    $user->username = $username;
    $user->email = $email;
    $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
    $user->save();
    return $user;
}

function authenticateUser($email = '', $password = '') {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row && password_verify($password, $row['password_hash'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user'] = $row;
        return true;
    }
    return false;
}

global $pdo;
$users = []; 
$stmt = $pdo->query('SELECT * FROM users');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user = new User();
    
    foreach ($row as $key => $value) {
        if (property_exists($user, $key)) {
            $user->$key = $value;
        }
    }
    
    $users[] = $user;
}

function getUserById($id = 0) {
    global $users;
    foreach ($users as $user) {
        if ($user->id == $id) {
            return $user;
        }
    }
    return null;
}

function getUserId() {
    $email = $_SESSION['email'] ?? '';
    global $users;
    foreach ($users as $user) {
        if ($user->email === $email) {
            return $user->id;
        }
    }
    return 0;
}

function getUsers() {
    global $users;
    return $users;
}

function containsPokemon($pokemon_name = '') {
    global $pdo;
    $user_id = getUserId();
    $stmt = $pdo->prepare('SELECT * FROM teams WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $team = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($team) {
        $pokemon_list = explode(',', $team['pokemon_list']);
        return in_array($pokemon_name, $pokemon_list);
    }
    return false;
}

function getTeam() {
    global $pdo;
    $user_id = getUserId();
    $stmt = $pdo->prepare('SELECT * FROM teams WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $team = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($team) {
        return explode(',', $team['pokemon_list']);
    }
    return [];
}

function addPokemonToTeam($pokemon_name = ''){
    global $pdo;
    $user_id = getUserId();
    $stmt = $pdo->prepare('SELECT * FROM teams WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $team = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($team) {
        $pokemon_list = explode(',', $team['pokemon_list']);
        $pokemon_list = array_values(array_filter($pokemon_list, 'strlen'));
        if (count($pokemon_list) >= 6) {
            return false;
        }
        if (!in_array($pokemon_name, $pokemon_list)) {
            $pokemon_list[] = $pokemon_name;
            $new_pokemon_list = implode(',', $pokemon_list);
            $update_stmt = $pdo->prepare('UPDATE teams SET pokemon_list = ? WHERE user_id = ?');
            $update_stmt->execute([$new_pokemon_list, $user_id]);
        }
    } else {
        $insert_stmt = $pdo->prepare('INSERT INTO teams (user_id, pokemon_list) VALUES (?, ?)');
        $insert_stmt->execute([$user_id, $pokemon_name]);
    }

    return true;
}

function removePokemonFromTeam($pokemon_name = '') {
    global $pdo;
    $user_id = getUserId();
    $stmt = $pdo->prepare('SELECT * FROM teams WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $team = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$team) {
        return false;
    }

    $pokemon_list = explode(',', $team['pokemon_list']);
    $pokemon_list = array_values(array_filter(array_map('trim', $pokemon_list), 'strlen'));

    if (!in_array($pokemon_name, $pokemon_list, true)) {
        return false;
    }

    $pokemon_list = array_values(array_filter($pokemon_list, function ($pokemon) use ($pokemon_name) {
        return $pokemon !== $pokemon_name;
    }));

    $new_pokemon_list = implode(',', $pokemon_list);
    $update_stmt = $pdo->prepare('UPDATE teams SET pokemon_list = ? WHERE user_id = ?');
    $update_stmt->execute([$new_pokemon_list, $user_id]);

    return true;
}
